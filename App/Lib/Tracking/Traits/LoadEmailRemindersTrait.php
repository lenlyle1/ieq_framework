<?php

namespace App\Lib\Tracking\Traits;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

trait LoadEmailRemindersTrait
{
    public static function loadEmailReminders($userId)
    {
        $sql = "SELECT *
                FROM text_reminders
                WHERE user_profile_id = ?";

        return Mysql::fetchAll($sql, [$userId]);
    }


}