<?php

namespace App\Lib\Progress;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class SaveSkillViewed extends Progress
{
    public static function save($userId, $item)
    {
        $sql = "UPDATE user_progress
                SET  last_skill_session = ?
                WHERE user_profile_id = ?";

        return Mysql::insertUpdate($sql, [$item, $userId]);
    }
}
