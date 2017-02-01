<?php

namespace App\Lib\Skills;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

class SkillsSaver extends Skills
{
    public static function save($user, $listId, $fieldOrder, $text)
    {
        $sql = "INSERT INTO user_list_items
                (user_profile_id, list_id, field_order, entry_text)
                VALUES
                (?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE
                entry_text = ?";

        Mysql::insertUpdate($sql, [$user, $listId, $fieldOrder, $text, $text]);

        return ['success' => true];
    }
}