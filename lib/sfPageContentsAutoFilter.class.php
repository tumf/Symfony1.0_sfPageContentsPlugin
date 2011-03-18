<?php
/**
 * 
 *
 * in apps/{app}/config/filters.yml
 *
 * <code>
 * <?php if (sfConfig::get('sf_environment') == 'dev'): ?> 
 * sfPageContentsAuto:
 *   class: sfPageContentsAutoFilter
 * <?php endif ?> 
 * </code>
 */
class sfPageContentsAutoFilter extends sfFilter
{
  public function execute ($filterChain)
  {
    if ($this->isFirstCall())
      {
        exec("cd ".SF_ROOT_DIR." && ./symfony snip-all",$lines);
        foreach ($lines as $line){
          if(preg_match("/^>>\s+\+file\s+.*/",$line)){
            sfLogger::getInstance()->info(sprintf("{%s} %s",__CLASS__,$line));
          }else{
            sfLogger::getInstance()->err(sprintf("{%s} %s",__CLASS__,$line));
          }
        }
      }
    $filterChain->execute();
  }
}