<?php

namespace App\Lib\Progress;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class ProgressSaver extends Progress
{
    public static function save($userId, $item, $page = 1)
    {
        $sql = "UPDATE user_progress
                SET " . $item . " = ?
                WHERE user_profile_id = ?";

        return Mysql::insertUpdate($sql, [$page, $userId]);
    }
}
