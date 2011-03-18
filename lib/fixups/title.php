<?php
/**
 *
 *  fixups
 *    -
 *      title:
 *
 *  replace-match:
 *    pattern: |<title>.*</title>|
 *    to-php: "include_title()"
 *
 */
function fixup_title($contents, $param = array())
{
  return preg_replace("|<title>.*</title>|",'<?php include_title() ?>',$contents);
}
