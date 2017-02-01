<?php

namespace App\Lib\User;

use \App\Lib\Mysql;

class UserLoadByUsername
{
    public static function load($username)
    {
        # Get user by user name:
        $sql = "SELECT *
                FROM user_profile
                WHERE username = ?";

        return Mysql::fetchOne($sql, [$username]);
    }
}