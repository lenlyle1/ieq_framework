<?php

namespace App\Lib\User;

use \App\Lib\Mysql;

class UserRatingLoader
{
    public static function load($userId, $childId)
    {
        $sql = "SELECT *, DATE_FORMAT(rating_date,'%m/%d/%y') AS nice_date
                FROM user_rating
                WHERE user_profile_id = ?
                AND child_id = ?
                ORDER BY rating_date ASC";

        return Mysql::fetchAll($sql, [
            $userId,
            $childId
        ]);
    }
}