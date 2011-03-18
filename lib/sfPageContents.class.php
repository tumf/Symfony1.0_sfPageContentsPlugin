<?php

/**
 * sfPageContents
 * 
 */
class sfPageContents
{
  static function loadConfig(){
    $config_file = sprintf("config/snipper.yml");
    if(!file_exists($config_file)){
      throw new sfException($config_file." not found.");
    }
    return sfYaml::load($config_file);
  }
  static function snipLayouts($app,$config)
  {
    if(isset($config["layouts"])){
      foreach($config["layouts"] as $name => $from){
        if($name == "all"){
          $all = $from;
          continue;
        }
        $layoutfile = sprintf("%s/%s",$config["htmldir"],$from["file"]);
        $layout = file_get_contents($layoutfile);
        $layout = __sfPageContentTask_rel2abs($config["htmldir"],$from["file"],$layout);
        $layout = __sfPageContentTask_filters($layout,$config);
        if(isset($config["layout"])){
          $layout = __sfPageContentTask_filters($layout,$config["layout"]);
        }
        $layout = __sfPageContentTask_encode($layout,$config);
        // $layout = __sfPageContentTask_layout_fix_ups($layout,$from);
        if(isset($from["fixups"])){
          $layout = __sfPageContentTask_fixup($layout,$from["fixups"]);
        }
        if(isset($all["fixups"])){
          $layout = __sfPageContentTask_fixup($layout,$all["fixups"]);
        }
        $file = sprintf("apps/%s/templates/%s.php",$app,$name);
        __sfPageContentTask_file_put_contents_if_modified($file,$layout);
      }
    }
  }
  static function snipPages($app, $config)
  {
    $snipped_pages_file = "data/fixtures/snipped-pages.yml";
    if(file_exists($snipped_pages_file)){
      @pake_remove($snipped_pages_file,null);
    }
    if(isset($config["pages"])){
      foreach($config["pages"] as $page_name => $page){
        $finder = sfFinder::type('file')
          ->ignore_version_control()
          ->follow_link()
          ->relative()
          ->name($page["name"]);
        $layout_default = $config["layouts"][$page["layout"]];
        $in = $config["htmldir"];
        if(isset($page["in"])){
          $in .= "/".$page["in"];
        }
        $files = $finder->in($in);
        $contents = array();
        $pages = array();
        
        $routes_file = "generated-routes.yml";
        if(isset($page["routes"]["file"])){
          $routes_file = $page["routes"]["file"];
        }
        $routes = "";
        foreach($files as $file){
          if(strlen($in) >0 && isset($page["in"]))
            $file = $page["in"] . "/" . $file;

          $module = "page";
          if(isset($pages["module"])){
            $module = $pages["module"];
          }
          $action = "show";
          if(isset($pages["action"])){
            $action = $pages["action"];
          }
            
          if(isset($page["pages"][$file]["module"])){
            $module = $page["pages"][$file]["module"];
            $action = $page["pages"][$file]["action"];
          }

          $name = sprintf("%s/%s",$app,$file);

          $layout = $layout_default;
          $pages[$name]["layout"] = $page["layout"];
          if(isset($page["pages"][$file]["layout"])){
            $pages[$name]["layout"] = $page["pages"][$file]["layout"];
            $layout = $config["layouts"][$page["pages"][$file]["layout"]];
          }            
            
          $html = file_get_contents($config["htmldir"]."/".$file);
          $html = __sfPageContentTask_rel2abs($config["htmldir"],$file,$html);
          $html = __sfPageContentTask_filters($html,$config);
          $html = __sfPageContentTask_encode($html, $config);
          // $html = __sfPageContentTask_encode($html, $page);
          $pages[$name]["name"] = $name;
          if(isset($page["description-re"])){
            if(preg_match($page["description-re"],$html,$m)){
              $pages[$name]["description"] = $m[1];
            }
          }
          if(isset($page["keywords-re"])){
            if(preg_match($page["keywords-re"],$html,$m)){
              $pages[$name]["keywords"] = $m[1];
            }
          }

          if(preg_match("|<title>(.*)</title>|",$html,$m)){
            $pages[$name]["title"] = $m[1];
          }
          $pages[$name]["body"]
            = __sfPageContentTask_wrapped_get($html,
                                              $layout["content"]["wrapped-begin-re"],
                                              $layout["content"]["wrapped-end-re"]);
          if(isset($page["fixups"])){
            $pages[$name]["body"]
              = __sfPageContentTask_fixup($pages[$name]["body"],
                                          $page["fixups"],
                                          $file);
          }

          if(isset($page["contents"]) && is_array($page["contents"])){
            foreach($page["contents"] as $k => $v){
              $id =  $name."_".$k;
              # $pages[$name]["contents"][] = $id;
              $page_contents[] = array("page_id" => $name,"content_id"=>$id);
              $contents[$id]["name"] = $k;
              $contents[$id]["body"]
                = __sfPageContentTask_wrapped_get($html,
                                                  $v["wrapped-begin-re"],
                                                  $v["wrapped-end-re"]);
            }
          }
          $routes .= sprintf("%s:\n".
                             "  url:   \"/%s\"\n".
                             "  param: { module: %s, action: %s, sf_page_contents_name: \"%s\"}\n"
                             ,$name,$file,$module,$action,$name);
        }
        
        $now = sfYaml::load($snipped_pages_file);
        if(isset($now["Content"])){
          if(is_array($contents)){
            $next["Content"] = array_merge($contents,$now["Content"]);
          }else{
            $next["Content"] = $now["Content"];
          }
        }else{
          $next["Content"] = $contents;
        }
        
        if(isset($now["Page"])){
          if(is_array($pages)){
            $next["Page"] = array_merge($pages,$now["Page"]);
          }else{
            $next["Page"] = $now["Page"];
          }
        }else{
          $next["Page"] = $pages;
        }
        if(isset($now["PageContent"])){
          if(is_array($page_contents)){
            $next["PageContent"] = array_merge($page_contents,$now["PageContent"]);
          }else{
            $next["PageContent"] = $now["PageContent"];
          }
        }else{
          $next["PageContent"] = $page_contents;
        }
        __sfPageContentTask_file_put_contents_if_modified($snipped_pages_file,sfYaml::dump($next));
        
        $file = sprintf("apps/%s/config/%s",$app,$routes_file);
        __sfPageContentTask_file_put_contents_if_modified($file,$routes);
        pake_echo_action('+file', $file);
      }
    }
  }

  static function snipTemplates($app,$config,$view=true)
  {
    if($view){
      if(!isset($config["views"])) return;
      $templates = $config["views"];
    }else{
      if(!isset($config["partials"])) return;
      $templates = $config["partials"];
    }
    if(isset($templates["all"])){
      $all = $templates["all"];
      unset($templates["all"]);
    }
    foreach($templates as $template){
      if(!isset($config["htmldir"]) || !isset($template["file"])
         || !isset($template["name"]) ){
        continue;
      }
      $sfile = $config["htmldir"]."/".$template["file"];
      if(!file_exists($sfile)){
        throw new sfException(sprintf("%s not exists.",$sfile));
      }
      if($view){
        $dfile = sprintf("apps/%s/modules/%s/templates/%s.php",
                         $app,$template["module"],$template["name"]);

      }else{
        if($template["module"] == "global"){
          $dfile = sprintf("apps/%s/templates/_%s.php",
                           $app,$template["name"]);
        }else{
          $dfile = sprintf("apps/%s/modules/%s/templates/_%s.php",
                           $app,$template["module"],$template["name"]);
        }
      }
      //
      //
      if(__sfPageContentTask_isModified($sfile,$dfile)){
        $src = file_get_contents($sfile);
        $src = __sfPageContentTask_rel2abs
          ($config["htmldir"],$template["file"],$src);
        $src = __sfPageContentTask_encode($src, $config);
        $src = __sfPageContentTask_encode($src, $template);
        if(isset($template["wrapped-begin-re"])
           && isset($template["wrapped-end-re"])){
          $src = __sfPageContentTask_wrapped_get
            ($src,
             $template["wrapped-begin-re"],
             $template["wrapped-end-re"]);
        }
        if(isset($template["fixups"])){
          $src = __sfPageContentTask_fixup($src,$template["fixups"],
                                           $template["file"]);
        }
        if(isset($all["fixups"])){
          $src = __sfPageContentTask_fixup($src,$all["fixups"],
                                           $template["file"]);
        }
        __sfPageContentTask_file_put_contents_if_modified($dfile,$src);
      }
    }
  }
  static function snipAssets($app,$config)
  {
    if(isset($config["assets"])){
      if(!is_array($config["assets"])) return;
      $in = $config["htmldir"];
      foreach($config["assets"] as $asset){
        $dir = "web/";
        if(isset($asset["dest"])){
          $dir = $asset["dest"];
        }
        if(isset($asset["name"])){
          $finder = sfFinder::type('file')
            ->ignore_version_control()
            ->follow_link()
            ->relative()
            ->name($asset["name"]);
          foreach($finder->in($in) as $file){
            if (isset($asset["rename"])){
              $dest = $dir . $asset["rename"];
            } else {
              $dest = $dir . $file;
            }
            self::copyIfModified($in."/".$file,$dest,array("override"=>true));
          }
        }elseif(isset($asset["dir"])){
          $finder = sfFinder::type('file')
            ->ignore_version_control()
            ->follow_link()
            ->relative();
          if(isset($asset["prune"])){
            $finder->prune($asset["prune"]);
          }
          if(isset($asset["discard"])){
            $finder->discard($asset["discard"]);
          }
          foreach($finder->in($in . "/".$asset["dir"]) as $file){
            $dest = $dir. $asset["dir"]."/".$file;
            self::copyIfModified($in."/".$asset["dir"]."/".$file, $dest, array("override"=>true));
          }
        }
      }
    }
  }
  /**
   * copyIfModified
   * 
   * @return true if copied
   */
  static function copyIfModified($from,$to,$options=array())
  {
    if (is_readable($to)){
      if (file_get_contents($to) == file_get_contents($from)){
        return false;
      }
    }
    pake_copy($from,$to,$options);
    return true;
  }

  static function loadFixUp($name){
    $fname = self::getFixupFunctionName($name);
    
    if (!function_exists($fname)){
      $finder = sfFinder::type('directory')
        ->ignore_version_control()
        ->follow_link()
        ->relative()
        ->name("lib");
      $dirs = $finder->in(".");
      foreach ($dirs as $dir){
        $finder = sfFinder::type('file')
          ->ignore_version_control()
          ->follow_link()
          ->relative()
          ->name(sprintf("%s.php",$name));
        $files = $finder->in($dir."/fixups");
        foreach ($files as $file){
          require_once($dir."/fixups/".$file);
          if (function_exists($fname)) break 2;
        }
      }
    }
    if (!function_exists($fname)){
      throw new sfException(sprintf("fixup: %s not found.",$fname));
    }
  }
  /**
   * run fixup script
   * $content = $this->runFixUp("component",$content, $param);
   * @return return
   */
  
  static function runFixUp($name, $content, $param = array())
  {
    self::loadFixUp($name);
    $fname = self::getFixupFunctionName($name);
    return call_user_func($fname,$content,$param);
  }
  /**
   * get fixup function by name
   * <code>
   * $fname = self::getFixupFunctionName($name);
   * </code>
   *
   * @return return
   */
  static function getFixupFunctionName($name){
    return "fixup_".strtr($name,"-","_");
  }

}
