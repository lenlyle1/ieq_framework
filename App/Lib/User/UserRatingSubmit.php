<?php

namespace App\Lib\User;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;
use \App\Lib\User\UserRatingLoader;

class UserRatingSubmit
{
    public static function rate($userId, $childId, $parentRating, $childRating)
    {
        // get last rating
        $ratings = UserRatingLoader::load($userId, $childId);
        $lastRating = array_pop($ratings);
        Debugger::debug($lastRating, 'last rating');
        $today = date('m/d/y');
        Debugger::debug($today, 'today');

        //if in same day update
        if(!empty($lastRating) && $today == $lastRating->nice_date){
            $sql = "UPDATE user_rating
                    SET parent_practice_rating = ?,
                        child_behavior_rating = ?,
                        rating_date = NOW()
                    WHERE user_rating_id = ?";

            Mysql::insertUpdate($sql, [
                $parentRating,
                $childRating,
                $lastRating->user_rating_id
            ]);
        } else {
            // else insert new rating
            $sql = "INSERT INTO user_rating (
                        user_profile_id,
                        child_id,
                        parent_practice_rating,
                        child_behavior_rating,
                        rating_date
                    ) VALUES (
                        ?,
                        ?,
                        ?,
                        ?,
                        NOW()
                    )";

            Mysql::insertUpdate($sql, [
                $userId,
                $childId,
                $parentRating,
                $childRating
            ]);
        }
    }
}
