<?php

namespace App\Lib\Tracking;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

class TrackingRateProgramSection extends Tracking
{
    public static function rate($userId, $listId, $rating)
    {
        $sql = "DELETE FROM list_rating
                WHERE user_profile_id = ?
                AND list_id = ?";

        Mysql::runQuery($sql, [$userId, $listId]);

        $sql = "INSERT INTO list_rating (
                    user_profile_id,
                    list_id,
                    rating
                ) VALUES (
                    ?, ?, ?
                )";

        Mysql::insertUpdate($sql, [$userId, $listId, $rating]);
    }
}