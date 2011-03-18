<?php

/**
 * Subclass for performing query and update operations on the 'page' table.
 *
 * 
 *
 * @package lib.model
 */ 
class PagePeer extends BasePagePeer
{
    public static function getCachedPageByName($name,$crit = null){
        if($crit == null){
            $crit = new Criteria;
        }
        $function_cache_dir = sfConfig::get('sf_cache_dir').'/function';      
        $cache = new sfFunctionCache($function_cache_dir);
        return $cache->call("PagePeer::getPageByName",$name,$crit);
    }
    public static function getPageByName($name,$crit = null){
        if($crit == null){
            $crit = new Criteria;
        }
        $crit->add(PagePeer::NAME,$name);
        return PagePeer::doSelectOne($crit);
    }
    public static function getCachedContentByName($page_name,$content_name,$crit = null){
        if($crit == null){
            $crit = new Criteria;
        }
        $function_cache_dir = sfConfig::get('sf_cache_dir').'/function';      
        $cache = new sfFunctionCache($function_cache_dir);
        return $cache->call("PagePeer::getContentByName",$page_name,$content_name,$crit);
    }
    public static function getContentByName($page_name,$content_name,$crit = null){
        if($crit == null){
            $crit = new Criteria;
        }
        $page = self::getPageByName($page_name,$crit);
        return $page->getContentByName($content_name,$crit);
    }
}
