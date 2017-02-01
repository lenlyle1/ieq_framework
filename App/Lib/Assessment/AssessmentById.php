<?php

namespace App\Lib\Assessment;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

class Assessment
{
    public static function load($assessmentId)
    {
        $sql = "SELECT *
                FROM assessment
                WHERE assessment_id = ?";

        Debugger::debug($sql, 'SQL');
        return Mysql::fetchOne($sql, [$assessmentId]);
    }
}
