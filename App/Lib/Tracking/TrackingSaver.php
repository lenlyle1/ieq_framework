<?php

namespace App\Lib\Tracking;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

class TrackingSaver extends Tracking
{
    static function saveLine($data)
    {
        Debugger::debug($data);
        // check for existing row
        $sql = "SELECT *
                FROM tracking_tool
                WHERE user_profile_id = ?
                AND list_id = ?
                AND field_order = ?";

        $row = Mysql::fetchOne($sql, [
            $data['user_profile_id'],
            $data['list_id'],
            $data['field_order']
        ]);

        if ($row) {
            $sql = "UPDATE tracking_tool
                    SET day_1 = ?,
                        day_2 = ?,
                        day_3 = ?,
                        day_4 = ?,
                        day_5 = ?,
                        day_6 = ?,
                        day_7 = ?
                    WHERE tracking_tool_id = ?";

            $params = [
                $data['day_1'],
                $data['day_2'],
                $data['day_3'],
                $data['day_4'],
                $data['day_5'],
                $data['day_6'],
                $data['day_7'],
                $row->tracking_tool_id
            ];
        } else {
            $sql = "INSERT INTO tracking_tool (
                        user_profile_id,
                        list_id,
                        field_order,
                        tracking_begin_date,
                        day_1,
                        day_2,
                        day_3,
                        day_4,
                        day_5,
                        day_6,
                        day_7
                    ) VALUES (
                        ?, ?, ?, NOW(), ?, ?, ?, ?, ?, ?, ?
                    )";

            $params = [
                $data['user_profile_id'],
                $data['list_id'],
                $data['field_order'],
                $data['day_1'],
                $data['day_2'],
                $data['day_3'],
                $data['day_4'],
                $data['day_5'],
                $data['day_6'],
                $data['day_7']
            ];
        }

        Debugger::debug($sql);
        $id = Mysql::insertUpdate($sql, $params);
    }
}
