<?php
/**
 * Subclass for representing a row from the 'page' table.
 *
 * 
 *
 * @package lib.model
 */ 
class Page extends BasePage
{
    /**
     * getContents()
     *
     * #test ->getContents()
     * <code>
     * </code>
     */
    public function getContents($crit = null){
        if(!$crit) $crit = new Criteria;
        return sfPropelManyToMany::getRelatedObjects($this,"PageContent",$crit);
    }
    public function getContentByName($name,$crit = null){
        if(!$crit) $crit = new Criteria;
        //$crit->add(ContentPeer::NAME,$name);
        foreach($this->getPageContents($crit) as $page_content){
            $content = $page_content->getContent();
            if($content->getName()==$name){
                return $content;
            }
        }
    }
    /**
     * setContents()
     *
     * #test ->setContents()
     * <code>
     * </code>
     */
    public function setContents($names){
        foreach($names as $order => $name){
            $crit = new Criteria;
            $crit->add(ContentPeer::NAME,$name);
            $c = ContentPeer::doSelectOne($crit);
            $page_content = new PageContent;
            $page_content->setShowOrder($order+1);
            $page_content->setContent($c);
            $this->addPageContent($page_content);
        }
    }
}
