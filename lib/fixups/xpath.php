<?php
function fixup_xpath($contents, $param = array())
{
  $results = array();
  
  $query = $param["query"];

  $doc = new DOMDocument;
  $doc->substituteEntities = false;
  @$doc->loadHTML($contents);
  
  $xpath = new DOMXpath($doc);
  foreach ($xpath->query($query) as $node){
    $xml = simplexml_import_dom($node);
    $results[] = $xml->asXML();
  }
  return implode("\n",$results);
}
