<?php
  /**
   * contentComponents
   * 
   *
   * @package    sfPageContentsPlugin
   * @subpackage content
   * @author     Yoshihiro TAKAHARA <takahara@dino.co.jp>
   * @version    SVN: $Id: components.class.php 337 2008-03-22 12:46:49Z tumf $
   *
   */
class contentComponents extends sfComponents
{
    public function executeShow(){
        $this->content = null;
        $page_name = $this->getRequest()->getAttribute("sf_page_contents_name");
        $page = PagePeer::getCachedPageByName($page_name);
        if($page){
            $this->content = PagePeer::getCachedContentByName($page_name,$this->name);
        }
    }
}
