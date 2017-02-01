<?php

namespace App\Lib\Progress;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class ProgressLoader extends Progress
{
    public static function load($userId)
    {
        $sql = "SELECT *
                FROM user_progress
                WHERE user_profile_id = ?";

        return Mysql::fetchOne($sql, [$userId]);
    }
}