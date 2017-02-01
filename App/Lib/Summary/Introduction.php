<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;

class Introduction extends Summary
{
    static function getSummary($childId)
    {
        $assessment = self::getAssessment($childId);

        foreach($assessment as $name => $value){
            // child qualities
            if(preg_match('/^child_qualities_([a-z_]+)/', $name, $matches)){
                if($value == 1){
                    self::$summary['child_qualities'][] = ucfirst(str_replace('_', ' ', $matches[1]));
                }
            }

            // child concerns
            if(preg_match('/^child_concerns_([a-z_]+)/', $name, $matches)){
                if($value == 1){
                    self::$summary['child_concerns'][] = ucfirst(str_replace('_', ' ', $matches[1]));
                }
            }

            // child positive school experiences
            if(preg_match('/^well_school_([a-z_]+)/', $name, $matches)){
                if($value == 1){
                    self::$summary['well_school'][] = ucfirst(str_replace('_', ' ', $matches[1]));
                }
            }

            // child school challenges
            if(preg_match('/^challenges_school_([a-z_]+)/', $name, $matches)){
                if($value == 1){
                    self::$summary['challenges_school'][] = ucfirst(str_replace('_', ' ', $matches[1]));
                }
            }

            // child school challenges
            if(preg_match('/^family_strengths_([a-z_]+)/', $name, $matches)){
                if($value == 1){
                    self::$summary['family_strengths'][] = ucfirst(str_replace('_', ' ', $matches[1]));
                }
            }

            // pass all fields back to template
            self::$summary[$name] = $value;
        }

        return self::$summary;
    }
}