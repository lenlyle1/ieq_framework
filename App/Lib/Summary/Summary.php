<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;
use \App\Lib\Assessment\AssessmentByChildId;

abstract class Summary
{

    use Traits\CalcScoreTrait;

    protected static $summary = ['not_applicable' => 'Not applicable'];

    protected static $assessment = null;

    protected static $grayText = 'Please answer more questions to get a more accurate summary';

    protected static function getAssessment($childId)
    {
        if (!self::$assessment) {
            self::$assessment = AssessmentByChildId::load($childId);
        }

        return self::$assessment;
    }
}