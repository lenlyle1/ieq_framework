<?php

namespace App\Lib\Summary\Traits;

use \App\Lib\Utils\Debugger;

trait CalcScoreTrait
{
    public static function calcScore($items)
    {
        // strip out all unselected answers
        $items = array_diff($items, [-9]);
        //Debugger::debug($items);
        // return the average
        if(count($items) > 0){
            return array_sum($items) / count($items);
        } else {
            return null;
        }
    }
}