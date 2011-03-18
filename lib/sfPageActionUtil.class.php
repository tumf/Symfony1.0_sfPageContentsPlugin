<?php
class sfPageActionUtil
{
    public static function setupAction($action,$name = null){
        if($name == null) {
            if($action
               ->getRequest()->hasAttribute("sf_page_contents_name")){
                $name = $action
                    ->getRequest()->getAttribute("sf_page_contents_name");
            }elseif($action
                    ->hasRequestParameter("sf_page_contents_name")){
                $name = $action
                    ->getRequestParameter("sf_page_contents_name");
            }else{
                return null;
            }
        }
        $action->getRequest()->setAttribute("sf_page_contents_name",$name);

        $page = PagePeer::getCachedPageByName($name);
        if($page){
            $action->setLayout($page->getLayout());
            $action->getResponse()->setTitle($page->getTitle());
            $action->getResponse()->addMeta("keywords",
                                            $page->getKeywords());
            $action->getResponse()->addMeta("description",
                                            $page->getDescription());
        }
        return $page;
    }
}
