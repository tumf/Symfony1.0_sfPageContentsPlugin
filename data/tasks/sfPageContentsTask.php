<?php
pake_desc('snip all from htmldir');
pake_task('snip-all','project_exists');
pake_desc('snip layouts from html');
pake_task('snip-layouts','project_exists');
pake_desc('snip pages from html');
pake_task('snip-pages','project_exists');
pake_desc('snip views from html');
pake_task('snip-views','project_exists');
pake_desc('snip partials from html');
pake_task('snip-partials','project_exists');

pake_desc('snip assets from htmldir');
pake_task('snip-assets','project_exists');


function run_snip_all($task,$args){
    run_snip_layouts($task,$args);
    run_snip_pages($task,$args);
    run_snip_views($task,$args);
    run_snip_partials($task,$args);
    run_snip_assets($task,$args);
}

function __sfPageContentTask_precheck($task,$args){
    if (count($args) < 1){
        throw new Exception('You must provide app.');
    }
    $app = array_shift($args);
    $config_file = sprintf("config/snipper.yml");
    if(!file_exists($config_file)){
        throw new sfException($config_file." not found.");
    }
    $configs = sfYaml::load($config_file);
    if(!isset($configs[$app])){
        throw new sfException("Not defined about ".$app);
    }
    if(!isset($configs[$app]["htmldir"])){
        throw new sfException("missing htmldir: .");
    }
    return  $configs[$app];
}

function __sfPageContentTask_encode($text, $config){
    if(!isset($config["encode"])) return $text;
    if(!isset($config["encode"]["from"])) $config["encode"]["from"] = "auto";
    return mb_convert_encoding($text,
                               $config["encode"]["to"],
                               $config["encode"]["from"]);

}
    
function run_snip_layouts($task,$args){
    $configs = sfPageContents::loadConfig();
    $app = null;
    if (count($args) < 1){
        foreach ($configs as $app => $config){
            return sfPageContents::snipLayouts($app,$configs[$app]);
        }
    }
    $app = array_shift($args);
    return sfPageContents::snipLayouts($app,$configs[$app]);
}

function run_snip_pages($task,$args){
    $configs = sfPageContents::loadConfig();
    $app = null;
    if (count($args) < 1){
        foreach ($configs as $app => $config){
            return sfPageContents::snipPages($app,$configs[$app]);
        }
    }
    $app = array_shift($args);
    return sfPageContents::snipPages($app,$configs[$app]);
}

function run_snip_views($task,$args){
    return __sfPageContentsTask_snip_templates($task,$args);
}
function run_snip_partials($task,$args){
  return __sfPageContentsTask_snip_templates($task,$args,false);
}

function __sfPageContentsTask_snip_templates($task,$args,$view=true){
    $configs = sfPageContents::loadConfig();
    $app = null;
    if (count($args) < 1){
        foreach ($configs as $app => $config){
          return sfPageContents::snipTemplates($app,$configs[$app],$view);
        }
    }
    $app = array_shift($args);
    return sfPageContents::snipTemplates($app,$configs[$app],$view);
}

function __sfPageContentTask_isModified($sfile,$dfile){
    if(!file_exists($sfile) || !file_exists($dfile) || filemtime($sfile) > filemtime($dfile)){
        return true;
    }
    return true;
    return false;
}

function run_snip_assets($task,$args){
    $configs = sfPageContents::loadConfig();
    $app = null;
    if (count($args) < 1){
        foreach ($configs as $app => $config){
            return sfPageContents::snipAssets($app,$configs[$app]);
        }
    }
    $app = array_shift($args);
    return sfPageContents::snipAssets($app,$configs[$app]);
}

function __sfPageContentTask_fixup($src,$fixups,$comment=""){
    if(!is_array($fixups)) return $src;
    foreach($fixups as $fixup){
        foreach($fixup as $command => $param){
            $pre = $src; // save pre-fixup
            if(isset($param["to"])){
                $param["to"] = str_replace("[?php","<?php",$param["to"]);
                $param["to"] = str_replace("?]","?>",$param["to"]);
            }
            if(isset($param["to-php"])){
                $param["to"] = "<?php " . $param["to-php"] ." ?>";
            }
            if($command == "replace"){
                if(isset($param["from"])){
                    $src = str_replace($param["from"],
                                       $param["to"],
                                       $src);
                }elseif(isset($param["begin-re"])){
                    $src = __sfPageContentTask_replace
                        ($src,$param["begin-re"],$param["end-re"],$param["to"]);                    
                }elseif(isset($param["wrapped-begin-re"])){
                    $src = __sfPageContentTask_wrapped_replace
                        ($src,$param["wrapped-begin-re"],$param["wrapped-end-re"],
                         $param["to"],true);   
                }
            }elseif($command == "replace-match"){
                if(!isset($param["pattern"])) throw new sfException("replace-match needs pattern.");
                if(!isset($param["to"])) throw new sfException("replace-match needs to.");
                $src = preg_replace($param["pattern"],$param["to"],$src);
            }elseif($command == "replace-once"){
                if(isset($param["from"])){
                    $lines = explode("\n",$src);
                    $out = array();
                    $replaced = false;
                    foreach($lines as $line){
                        if(!$replaced){
                            $out[]=
                                str_replace($param["from"],
                                            $param["to"],
                                            $line,$count);
                            if($count > 0) {
                                $replaced = true;
                            }
                        }else{
                            $out[] = $line;
                        }
                    }
                    $src = implode("\n",$out);
                }elseif(isset($param["begin-re"])){
                    $src = __sfPageContentTask_replace
                        ($src,$param["begin-re"],$param["end-re"],
                         $param["to"],true);                    
                }elseif(isset($param["wrapped-begin-re"])){
                    $src = __sfPageContentTask_wrapped_replace
                        ($src,$param["wrapped-begin-re"],$param["wrapped-end-re"],
                         $param["to"],true);                    
                }
            }elseif($command == "replace-block"){
                if(isset($param['name'])){
                    $param["wrapped-begin-re"] = sprintf("|<!--\s*###\s*%s\s*-->|",$param["name"]);
                    $param["wrapped-end-re"] = sprintf("|<!--\s*###\s*/%s\s*-->|",$param["name"]);
                    
                    $src = __sfPageContentTask_wrapped_replace
                        ($src,$param["wrapped-begin-re"],$param["wrapped-end-re"],$param["to"],false);
                }
            }elseif($command == "filter"){
                $src = call_user_func_array($param["func"],
                                            array_marge(array($src) , $param["param"]));
            }elseif($command == "wrap-with"){
                if(isset($param["before-php"])){
                    $param["before"] = "<?php " . $param["before-php"] ." ?>";

                }
                if(isset($param["after-php"])){
                    $param["after"] = "<?php " . $param["after-php"] ." ?>";

                }
                if(!isset($param["after"])){
                    $param["after"] = false;
                }
                if(!isset($param["before"])){
                    $param["before"] = false;
                }
                $src = __sfPageContentTask_wrap_with
                    ($src,$param["begin-re"],$param["end-re"],$param["before"],$param["after"]);
            }elseif($command == "replace-tag"){
                $src = __sfPageContentTask_replace_tag
                    ($src,$param["tag"],$param["to"]);
            }elseif($command == "use_helper"){
                $args = "";
                foreach($param as $helper){
                    $args[] = '"'.$helper.'"';
                }
                $src = sprintf("<?php use_helper(%s) ?>\n",implode(",",$args)).$src;
            }else{
              $src = sfPageContents::runFixUp($command, $src, $param);
            }
            
            if(is_array($param) && array_key_exists("debug",$param)){
                $debug = true;
                __sfPageContentTask_fixup_debug($command,$param,$pre,$src);
            }else{
                $debug = false;
            }
            //
            if($src == $pre || $src == $pre."\n" || $src == ""){
                ob_start();
                var_dump($param);
                $param_d = ob_get_contents();
                ob_end_clean();
                // not fixed up. optional?
                if(!is_array($param) || !array_key_exists("optional",$param)){
                    __sfPageContentTask_fixup_debug($command,$param,$pre,$src);
                    throw new sfException
                        (sprintf("missing required fix: %s command '%s' %s",
                                 $comment,
                                 $command,$param_d));
                }
            }
        }
    }
    return $src;
}
function __sfPageContentTask_fixup_debug($command,$param,$pre,$src){
    pake_echo(" command ==============================");
    var_dump($command);
    pake_echo(" param ==============================");
    var_dump($param);
    pake_echo(" original ==============================");
    pake_echo($pre);
    pake_echo(" converted ==============================");
    pake_echo($src);
    pake_echo(" diff ==============================");
    $tmp_src=tempnam("/tmp","sfPageContentsTask");
    $tmp_dest=tempnam("/tmp","sfPageContentsTask");
    file_put_contents($tmp_src,$pre);
    file_put_contents($tmp_dest,$src);
    system("diff -uN $tmp_src $tmp_dest");
    pake_remove($tmp_src,null);
    pake_remove($tmp_dest,null);
}

function __sfPageContentTask_filters($src,$config){
    if(!isset($config["filters"])) return $src;
    if(!is_array($config["filters"])) return $src;
    foreach($config["filters"] as $filter){
        $params = array_merge(array($src) , $filter["param"]);
        $src = call_user_func_array($filter["func"],$params);
    }
    return $src;
}
function __sfPageContentTask_wrapped_get($src,$begin,$end){
    $in = false;
    $dest = array();
    $lines = explode("\n",$src);
    foreach($lines as $line){
        if($in){
            if(preg_match($end,$line)){
                $in = false;
                break;
            }
            $dest[] = $line ;
        }else{
            if(preg_match($begin,$line)){
                $in = true;
            }
        }
    }
    return implode("\n",$dest);
    //return preg_replace("/^\n+/","",$dest);
}
function __sfPageContentTask_wrapped_replace($src,$begin,$end,$with){
    $in = false;
    $dest = array();
    $lines = explode("\n",$src);
    
    foreach($lines as $line){
        if($in){
            if(preg_match($end,$line)){
                $in = false;
                $dest[] = $line;
            }
        }else{
            $dest[] = $line ;
            if(preg_match($begin,$line)){
                $in = true;
                $dest[] = $with;
            }
        }
    }
    return implode("\n",$dest);
}
function __sfPageContentTask_replace($src,$begin,$end,$with,$once=false){
    $in = false;
    $dest = array();
    $lines = explode("\n",$src);
    $replaced = false;
    foreach($lines as $line){
        if($in){
            if(preg_match($end,$line)){
                $in = false;
            }
        }else{
            if(!$replaced && preg_match($begin,$line)){
                $in = true;
                if($once) $replaced = true;
                $dest[] = $with;
            }else{
                $dest[] = $line;
            }
        }
    }
    return implode("\n",$dest);
}
function __sfPageContentTask_layout_fix_ups($layout,$fixups){

    // $layout = __sfPageContentTask_fixup($layout,$fixups);
    if(isset($fixups["content"])){
        $content = $fixups["content"];
        $layout =
            __sfPageContentTask_wrapped_replace($layout,
                                                $content["wrapped-begin-re"],
                                                $content["wrapped-end-re"],
                                                "<?php echo \$sf_data->getRaw('sf_content') ?>");
    }
    
    if(isset($fixups["components"]) && is_array($fixups["components"])){
        foreach($fixups["components"] as $name => $content){
            $params = "";
            if(isset($content["params"])){
                $params = ",array(";
                foreach($content["params"] as $k => $v){
                    $params .= sprintf("'%s'=>'%s',",$k,$v);
                }
                $params .= ")";
            }
            $layout =
                __sfPageContentTask_wrapped_replace($layout,
                                                    $content["wrapped-begin-re"],
                                                    $content["wrapped-end-re"],
                                                    sprintf("<?php include_component('%s','%s' %s) ?>",
                                                            $content["module"],
                                                            $content["component"],
                                                            $params));
        }
    }
    
    $layout =
        preg_replace("|<title>.*</title>|","<?php include_title() ?>
<?php include_http_metas() ?>
<?php include_metas() ?>
",$layout);
    
    $layout =
        preg_replace("|<meta [^>]+/>|","",$layout);
    return $layout;
}

/**
 * __sfPageContentTask_rel2abs($root,$file,$src)
 *
 * #test __sfPageContentTask_rel2abs_()
 * <code>
 * #is(__sfPageContentTask_rel2abs(
 *    "","a/b/c.html",
 *    "<a href=\"../a.html\">")
 *   ,"<a href=\"/a/a.html\">");
 * #is(__sfPageContentTask_rel2abs(
 *    "","a/b/c.html",
 *    "<a id='a' href=\"../a.html\">")
 *   ,"<a id='a' href=\"/a/a.html\">");
 * #is(__sfPageContentTask_rel2abs(
 *    "","a/b/c.html","<a id='a' href=\"mailto:hoge@example.com\">"),
 *    "<a id='a' href=\"mailto:hoge@example.com\">","mailto");
 * </code>
 * 
 * @param $root obsolated.
 *
 */
function __sfPageContentTask_rel2abs($root,$file,$src){
    if(preg_match_all("/<(a|link|img|script|input|iframe)( [^>]*)(src|href)(=['\"])([^'\"]*)(['\"])/",$src,$ms)){
        foreach($ms[0] as $k =>$from){
            $url = $ms[5][$k];
            if(strlen($url) > 0){
                $url= __sfPageContentTask_rel2abs_replace($file,$url);
            }
            $to = "<".$ms[1][$k].$ms[2][$k].$ms[3][$k].$ms[4][$k].$url.$ms[6][$k];
            $src = str_replace($from,$to,$src);            
        }
    }
    return $src;
}

/**
 * #test __sfPageContentTask_rel2abs_replace()
 * <code>
 * #is(__sfPageContentTask_rel2abs_replace("a/b/c/d/e/f.html","./../../../c/i/f.png"),
 *       "/a/b/c/i/f.png");
 * #is(__sfPageContentTask_rel2abs_replace("d/e/f.html","./c/i/f"),
 *       "/d/e/c/i/f");
 * #is(__sfPageContentTask_rel2abs_replace(
 *       "m/index.html","common/image/1.gif"),
 *       "/m/common/image/1.gif");
 * </code>
 */
function __sfPageContentTask_rel2abs_replace($file,$url){
    if(preg_match("|^/|",$url)) return $url;
    if(preg_match("|^#|",$url)) return $url;
    if(preg_match("|^https?://|",$url)) return $url;
    if(preg_match("|^mailto:|",$url)) return $url;
    $abs = "/" . dirname($file)."/".$url;
    $abs = str_replace("/./","/",$abs);
    do{
        $abs = preg_replace("|/[^/]+/../|","/",$abs,-1,$c);
    }while($c);
    return $abs;
}

/**
 * 指定範囲行の前後を指定した行で挟む
 *
 * #test __sfPageContentTask_wrap_with()
 * <code>
 * $src = "
 * abcd
 * efgh
 * ijkl
 * opqr
 * ";
 * $dest = "
 * abcd
 * ***
 * efgh
 * ijkl
 * opqr
 * $$$
 * ";
 * #is(__sfPageContentTask_wrap_with($src,"/efgh/","/opqr/","***","$$$"),$dest,"standard usage.");
 * #is(__sfPageContentTask_wrap_with($src,"/efgh/","/opqr/",false,false),$src,"when before and after are null.");
 * </code>
 */
function __sfPageContentTask_wrap_with($src,$begin,$end,$before,$after){
    $in = false;
    $dests = array();
    $lines = explode("\n",$src);
    
    foreach($lines as $line){
        if($in){
            $dests[] = $line;
            if(preg_match($end,$line)){
                $in = false;
                if($after)
                    $dests[] = $after;
            }
        }else{
            if(preg_match($begin,$line)){
                $in = true;
                if($before)
                    $dests[] = $before;
            }
            $dests[] = $line;
        }
    }
    return implode("\n",$dests);
}
/**
 * タグの置き換え
 *
 * sample yaml
 * <code>
 * replace-tag:
 *   tag: input
 *   -
 *     attributes:
 *       id: "myid"
 *     template-php: |
 *       echo input_tag("@name","@value",@attributes)
 * </code>
 *
 * #test __sfPageContentTask_replace_tag()
 * <code>
 * $src = '
 * <div>
 * test <input id="id1" name="name1" 
 * value="ok" type="text" class="class1"  /> hogefuga
 * </div>
 * <input type="text" value="testval"/>
 * <select id="select1" name="fuga"> dfjdalsfjdsafj  </select>
 * ';
 * $to[0] = array(
 * "attributes" => array( "id" => "abcd"),
 * "template" => '<?php echo input_tag("@name","@value",@attributes) ?>'
 * );
 * $to[1] = array(
 * "attributes" => array( "id" => "efgh"),
 * "template" => '<?php echo input_tag("@name","@value",@attributes) ?>'
 * );
 * $to2[0] = array(
 * "attributes" => array( "id" => "ijkl"),
 * "template" => '<?php echo select_tag("@name","@value",@attributes) ?>'
 * );
 *
 * //var_dump(__sfPageContentTask_replace_tag($src,"input",$to));
 * //var_dump(__sfPageContentTask_replace_tag($src,"select",$to2));
 *
 * </code>
 */
function __sfPageContentTask_replace_tag($src,$tag,$to){
    $i = 0;
    $cur = 0;
    while(true){
        $beg = strpos($src,"<".$tag,$cur);
        if($beg === false) break;
        $end = strpos($src,">",$beg);
        if($end === false) break;
        if(substr($src,$end-1,1) != "/"){
            // <select > ..... </select>
            $close_tag = "</".$tag.">";
            $end = strpos($src, $close_tag, $end);
            if($end === false) break;
            $end += strlen($close_tag)-1;
        }
        $xml = substr($src,$beg,$end-$beg+1);
        // var_dump($xml);
        $e = simplexml_load_string($xml);
        $attr = array();
        $name = "";$value = "";$type = "text";
        foreach($e->attributes() as $k => $v){
            if($k=="name"){
                $name = $v[0];
            }elseif($k=="type"){
                $type = $v[0];
            }elseif($k=="value"){
                $value = $v[0];
            }else{
                $attr[$k] = (string)$v[0];
            }
        }
        if(isset($to[$i]["attributes"])){
            foreach($to[$i]["attributes"] as $ak => $av){
                if(strlen($av)){
                    $attr[$ak] = $av;
                }else{
                    unset($attr[$ak]);
                }
            }
        }
        // template replace
        if(isset($to[$i]["template-php"])){
            $to[$i]["template"] = sprintf("<?php %s ?>" ,$to[$i]["template-php"]);
        }
        if(isset($to[$i]["template"])){
            $p = array("/@name/","/@type/","/@value/","/@attributes/");
            $r = array($name,$type,$value,var_export($attr,true));
            $to_string = preg_replace($p,$r,$to[$i]["template"]);
        }

        $src = substr($src,0,$beg).$to_string.substr($src,$end+1);
        $i++;
        if(!isset($to[$i])) break;
        $cur = $beg + strlen($to_string);
    }
    return $src;
}
function __sfPageContentTask_file_put_contents_if_modified($file,$contents){
    $org = "";
    if(is_readable($file)){
            $org  = file_get_contents($file);
    }
    if($org != $contents){
        file_put_contents($file,$contents);
        pake_echo_action('+file', $file);
    }
}


