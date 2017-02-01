<?php

namespace App\Lib\Logging;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;
use \App\Lib\Page\Loader as PageLoader;
use \App\Lib\Page\Saver as PageSaver;

class PageHit
{
    public static function log($sessionId, $pageName, $type, $url)
    {
        if(!$page = PageLoader::load($pageName)){
            Debugger::debug('Page not found');
            $pageId = PageSaver::save($type, $pageName);
        } else {
            $pageId = $page->page_id;
        }

        $sql = "INSERT INTO page_hit (
                    session_id,
                    page_id,
                    url,
                    hit_time
                ) VALUES (
                    ?,
                    ?,
                    ?,
                    NOW()
                )";

        Mysql::insertUpdate($sql, [
            $sessionId,
            $pageId,
            $url
        ]);
    }
}