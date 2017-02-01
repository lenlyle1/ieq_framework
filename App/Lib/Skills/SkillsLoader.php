<?php

namespace App\Lib\Skills;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

class SkillsLoader extends Skills
{
    public static function load($userId, $listId = null)
    {
        $params = [$userId];
        $sql = "SELECT *
                FROM user_list_items
                WHERE user_profile_id = ? ";

        if ($listId) {
            $sql .= "AND list_id = ? ";
            $params[] = $listId;
        }

        $sql .= "ORDER BY field_order ASC";

        $skills = Mysql::fetchAll($sql, $params);

        return $skills;
    }
}