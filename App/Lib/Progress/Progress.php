<?php

namespace App\Lib\Progress;

use \App\Lib\Utils\Debugger;
use \App\Lib\Mysql;

abstract class Progress
{
    protected static $progress = [
        'viewed_assessment',
        'viewed_assessment_results',
        'viewed_skills_home',
        'viewed_positive_parenting',
        'viewed_set_limits',
        'viewed_monitoring',
        'viewed_open_communication',
        'finished_positive_parenting',
        'finished_set_limits',
        'finished_monitoring',
        'finished_open_communication',
        'finished_tracking_tool'
    ];

    public static function create($userId)
    {
        $sql = "INSERT INTO user_progress (
                    user_profile_id
                ) VALUES (?)";

        Mysql::insertUpdate($sql, [$userId]);
    }
}