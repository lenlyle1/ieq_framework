<?php

namespace App\Lib\User;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;
use \App\Lib\User\UserMorningRoutineLoader;

class UserMorningRoutineSaver
{
    public static function save($userId, $params)
    {
        if ($params['user_morning_routine_id']) {
            // Update
            $sql = "UPDATE user_morning_routine
                    SET start_hour = ?,
                        start_minutes = ?,
                        text_1 = ?,
                        mins_1 = ?,
                        text_2 = ?,
                        mins_2 = ?,
                        text_3 = ?,
                        mins_3 = ?,
                        text_4 = ?,
                        mins_4 = ?,
                        text_5 = ?,
                        mins_5 = ?,
                        text_6 = ?,
                        mins_6 = ?
                    WHERE user_morning_routine_id = ?
                    AND user_profile_id = ?";

            $values = [
                $params['start_hour'],
                $params['start_minutes'],
                $params['text_1'],
                $params['mins_1'],
                $params['text_2'],
                $params['mins_2'],
                $params['text_3'],
                $params['mins_3'],
                $params['text_4'],
                $params['mins_4'],
                $params['text_5'],
                $params['mins_5'],
                $params['text_6'],
                $params['mins_6'],
                $params['user_morning_routine_id'],
                $userId,
            ];
        } else {
            // Insert
            $sql = "INSERT INTO user_morning_routine (
                        user_profile_id,
                        start_hour,
                        start_minutes,
                        text_1,
                        mins_1,
                        text_2,
                        mins_2,
                        text_3,
                        mins_3,
                        text_4,
                        mins_4,
                        text_5,
                        mins_5,
                        text_6,
                        mins_6
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                    )";


            $values = [
                $userId,
                $params['start_hour'],
                $params['start_minutes'],
                $params['text_1'],
                $params['mins_1'],
                $params['text_2'],
                $params['mins_2'],
                $params['text_3'],
                $params['mins_3'],
                $params['text_4'],
                $params['mins_4'],
                $params['text_5'],
                $params['mins_5'],
                $params['text_6'],
                $params['mins_6']
            ];
        }

        Debugger::debug($values, 'VALUES');
        return Mysql::insertUpdate($sql, $values);
    }
}
