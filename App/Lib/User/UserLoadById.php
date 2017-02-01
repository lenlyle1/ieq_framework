<?php

namespace App\Lib\User;

use \App\Lib\Mysql;

class UserLoadById
{
    public static function load($userId)
    {
        # Get user by user name:
        $sql = "SELECT *
                FROM user_profile
                WHERE user_profile_id = ?";

        return Mysql::fetchOne($sql, [$userId]);
    }
}