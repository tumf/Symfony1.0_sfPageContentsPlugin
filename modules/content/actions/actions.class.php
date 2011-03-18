<?php
/**
 * content actions.
 *
 * @package    sfPageContentsPlugin
 * @subpackage content
 * @author     Yoshihiro TAKAHARA <takahara@dino.co.jp>
 * @version    SVN: $Id: actions.class.php 293 2008-03-13 14:19:52Z tumf $
 */
class contentActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
}
