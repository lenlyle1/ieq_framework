<?php

namespace App\Lib\Tracking;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;
use \App\Lib\Skills\SkillsLoader;

class TrackingLoader extends Tracking
{
    use Traits\LoadEmailRemindersTrait;

    public static function load($userId)
    {
        $tracking = [];

        // load skills and assign by list
        $skills = SkillsLoader::load($userId);
        foreach (SkillsLoader::parseItems($skills, true) as $listId => $fields) {
            $tracking[$listId]['skills'] = $fields;
        }

        //load ratings and assign to list
        foreach (self::loadRatings($userId) as $id => $rating) {
            $tracking[$rating->list_id]['rating'] = $rating->rating;
        }

        // load email reminders
        foreach (self::loadEmailReminders($userId) as $id => $reminder) {
            Debugger::debug($reminder);
            $tracking['programReminders'][$reminder->program_section_id] = true;
        }

        //load tracking, assign to list
        $sql = "SELECT *
                FROM tracking_tool
                WHERE user_profile_id = ?";

        $trackingLines = Mysql::fetchAll($sql, [$_SESSION['user']]);

        foreach ($trackingLines as $k => $line) {
            $tracking[$line->list_id]['lines'][$line->field_order] = $line;
        }

        return $tracking;
    }

}