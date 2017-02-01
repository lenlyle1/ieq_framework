<?php

namespace App\Lib\Assessment;

use App\Lib\Utils\Debugger;
use App\Lib\Mysql;

class AssessmentCreator
{
    // create new empty assessment for new child
    public static function save($childId)
    {
        $sql = "INSERT INTO assessment
                (child_id) VALUES (?)";

        $assessmentId = Mysql::insertUpdate($sql, [$childId]);

        return $assessmentId;
    }
}
