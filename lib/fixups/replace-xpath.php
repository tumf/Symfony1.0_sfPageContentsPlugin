<?php
function fixup_replace_xpath($contents, $param = array())
{
  $c = array();
  $phps = array();
  $tokens=token_get_all($contents);
  $i = 0;
  foreach($tokens as $token){
    if(is_string($token)){
      $c[] ="<!-- [?php tid='$i' ?] -->";
      $phps[$i++] = $token;
    }else{
      list($id,$text) = $token;
      if($id == T_INLINE_HTML){
        $c[] = $text;
      }else{
        $c[] ="<!-- [?php tid='$i' ?] -->";
        $phps[$i++] = $text;
      }
    }
  }

  $r = implode($c);
  
  $results = array();
  
  $query = $param["query"];
  $to = $param["to"];

  $marker = "==sfPageContents:fixup_replace_xpath:replace-marker==";
  $del_marker_beg = "<!-- ==sfPageContents:fixup_replace_xpath:delete-marker-beg== -->";
  $del_marker_end = "<!-- ==sfPageContents:fixup_replace_xpath:delete-marker-end== -->";

  $doc = new DOMDocument;
  $doc->substituteEntities = false;
  //$doc->preserveWhiteSpace = false;
  //$doc->formatOutput = false;
  $fixup = false;
  $fixup_pre1 = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">';
  $fixup_pre2 = "<html><head></head><body>";
  $fixup_post = "</body></html>";
  //$r = mb_convert_encoding($r,'HTML-ENTITIES','UTF-8');
  if(!preg_match("/^<!DOCTYPE/",$r)){
    // HTMLの一部と見なす。
    $fixup = true;
    $r =  $fixup_pre1.$fixup_pre2.$r.$fixup_post;
  }

  //
  $r = str_replace("<head>"
                   ,"<head>\n".'<meta http-equiv="content-type" content="text/html; charset=utf-8">',$r);
  @$doc->loadHTML($r);
  
  $to_node = $doc->createTextNode($marker);
  
  $xpath = new DOMXpath($doc);
  $replace_count = 0;
  foreach ($xpath->query($query) as $node){
    $parent = $node->parentNode;
    $parent->replaceChild($to_node,$node);
    $replace_count++;
  }
  if($replace_count == 0){
    return $contents;
  }
  //$doc->normalize();
  $results = array();
  $r = (string)$doc->saveHTML();
  if($fixup){
    $r = str_replace($fixup_pre1,"",$r);
    $r = preg_replace("|<html>[\s]*\n?|","",$r,1);
    $r = preg_replace("|</html>[\s]*\n?|","",$r,1);
    $r = preg_replace("|<head>[\s]*\n?|","",$r,1);
    $r = preg_replace("|</head>[\s]*\n?|","",$r,1);
    $r = preg_replace("|<body>[\s]*\n?|","",$r,1);
    $r = preg_replace("|</body>[\s]*\n?|","",$r,1);
  }
  //$r = mb_convert_encoding($r, 'UTF-8', 'HTML-ENTITIES');

  foreach($phps as $k => $p){
    $r = str_replace("<!-- [?php tid='$k' ?] -->",$p,$r);
  }
  $r = str_replace($marker,$to,$r);
  $r = preg_replace("|<meta [^>]+utf-8[^>]+>[\s]*\n?|","",$r,1);
  return $r;
}
