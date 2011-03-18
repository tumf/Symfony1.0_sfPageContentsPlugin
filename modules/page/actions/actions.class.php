<?php
/**
 * page actions.
 *
 * @package    sfPageContentsPlugin
 * @subpackage page
 * @author     Yoshihiro TAKAHARA <takahara@dino.co.jp>
 * @version    SVN: $Id: actions.class.php 332 2008-03-21 12:06:22Z tumf $
 */
class pageActions extends sfActions
{
  public function executeShow(){
      $this->page = sfPageActionUtil::setupAction($this);
      $this->forward404Unless($this->page);
  }
}
