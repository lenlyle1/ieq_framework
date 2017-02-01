<?php

namespace App\Lib\Assessment;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

abstract class AssessmentUpdater extends Assessment
{
    public static function save($request)
    {
        $params = $request->getParsedBody();

        Debugger::debug($params);
        $values = [];

        foreach($params as $k => $v){
            // $fields[] = $k;
            $values[] = $v;
        }

        $sql = "UPDATE assessment
                SET ";
            foreach($params as $k => $v){
                $sql .= $k . ' = ?,';
            }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE assessment_id = ?";

        $values[] = $params['assessment_id'];

        Debugger::debug($sql);
        Debugger::debug($values);
        $assessmentId = Mysql::insertUpdate($sql, $values);
        if ($params['assessment_id']) {
            $assessmentId = $params['assessment_id'];
        }
        Debugger::debug($assessmentId);
        return $params['child_id'];
    }
}
