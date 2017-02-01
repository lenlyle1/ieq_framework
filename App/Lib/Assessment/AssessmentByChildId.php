<?php

namespace App\Lib\Assessment;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class AssessmentByChildId extends Assessment
{
    public static function load($childId)
    {
        $sql = "SELECT *
                FROM assessment
                WHERE child_id = ?";

        Debugger::debug($sql, 'SQL');
        return Mysql::fetchOne($sql, [$childId]);
    }
}
