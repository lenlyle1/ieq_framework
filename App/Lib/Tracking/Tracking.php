<?php

namespace App\Lib\Tracking;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

abstract class Tracking
{
    protected static function loadRatings($userId)
    {
        $sql = "SELECT *
                FROM list_rating
                WHERE user_profile_id = ?";

        return Mysql::fetchAll($sql, [$userId]);
    }
}