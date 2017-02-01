<?php

namespace App\Lib\Tracking;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

class TrackingToggleEmail extends Tracking
{
    static function toggle($userProfileId, $sectionId, $textReminders)
    {
        if ($textReminders == 'false') {
            $sql = "DELETE FROM text_reminders
                    WHERE user_profile_id = ?
                    AND program_section_id = ?";

            $params = [$userProfileId, $sectionId];
        } else {
            $sql = "INSERT INTO text_reminders(
                        user_profile_id,
                        program_section_id,
                        send_text_reminders,
                        text_reminder_begin_date
                    ) VALUES (
                        ?, ?, true, NOW()
                    )";

            $params = [$userProfileId, $sectionId];
        }

        Mysql::runQuery($sql, $params);

        self::saveHistory($userProfileId, $sectionId, $textReminders);
    }

    static function saveHistory($userProfileId, $sectionId, $textReminders)
    {
        $sql = "INSERT INTO text_reminders_history(
                        user_profile_id,
                        program_section_id,
                        send_text_reminders,
                        text_reminder_begin_date
                    ) VALUES (
                        ?, ?, ?, NOW()
                    )";

        $toggleBit = ($textReminders == 'true') ? 1 : 0;

        $params = [$userProfileId, $sectionId, $toggleBit];

        Mysql::runQuery($sql, $params);
    }
}
