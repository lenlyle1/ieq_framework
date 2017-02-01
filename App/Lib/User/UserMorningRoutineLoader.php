<?php

namespace App\Lib\User;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class UserMorningRoutineLoader
{
    public static function load($userId)
    {
        $sql = "SELECT *
                FROM user_morning_routine
                WHERE user_profile_id = ?";

        return Mysql::fetchOne($sql, [$userId]);
    }
}
