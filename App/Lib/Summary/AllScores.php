<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;

class AllScores extends Summary
{
    public static function getSummary($childId)
    {
        Family::getSummary($childId);
        Behaviors::getSummary($childId);
        Parenting::getSummary($childId);

        return self::$summary;
    }
}