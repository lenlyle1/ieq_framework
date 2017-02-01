<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;

class Family extends Summary
{
    public static function getSummary($childId)
    {
        $assessment = self::getAssessment($childId);


        /*----------------------------------------------------------------------
        |   Conflict score
        ----------------------------------------------------------------------*/
        $conflictScore = self::calcScore([
            $assessment->got_angry,
            $assessment->got_way
        ]);

        if ($conflictScore !== null) {
            if ($conflictScore >= 3) {
                $color = 'red';
                $text ='You reported a high level of family conflict. Using the recommended parenting skills may help your family get along better.';
            } else if (($conflictScore >= 2) && ($conflictScore <= 2.99)) {
                $color = 'yellow';
                $text = "This area may need some attention. Use of some new parenting skills may help your family get along better.";
            } else if ($conflictScore <= 1.99) {
                $color = 'green';
                $text = "You reported your family is not experiencing conflict at this time.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['family_conflict'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |   Stress score
        ----------------------------------------------------------------------*/
        $stressScore = self::calcScore([
            $assessment->stress_interactions,
            $assessment->current_stress
        ]);

        if ($stressScore !== null) {
            if ($stressScore >= 3.01) {
                $color = 'red';
                $text ='You reported your family is experiencing a lot of stress right now. Tips in this program may help you manage your stress.';
            } else if (($stressScore >= 2) && ($stressScore <= 3)) {
                $color = 'yellow';
                $text = "Stress may be an area that could use some attention in your family. Use the recommended parenting skills to help you manage better.";
            } else if ($stressScore <= 1.99) {
                $color = 'green';
                $text = "You reported family stress is not a problem at this time.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['family_stress'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |   Caregiver support score
        ----------------------------------------------------------------------*/
        $caregiverScore = self::calcScore([
            $assessment->religious_community,
            $assessment->spouse,
            $assessment->friend_coworker,
            $assessment->psych,
            $assessment->relative,
            $assessment->coach,
            $assessment->nurse
        ]);

        if ($caregiverScore !== null) {
            if ($caregiverScore <= 0.12) {
                $color = 'red';
                $text ='You report few sources of support at this time. You may benefit from developing more social support.from friends and family.';
            } else if (($caregiverScore >= 0.13) && ($caregiverScore <= 0.25)) {
                $family_conflict = 'yellow';
                $family_conflict_text = "You have some support people in your life, and you may benefit from increasing the amount of support you receive.";
            } else if ($caregiverScore >= 0.26) {
                $color = 'green';
                $text = "Getting the support you need from friends, family or professionals is a strength for you. Continue practicing this important self-care strategy.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['caregiver_support'] = [
            'color' => $color,
            'text'  => $text
        ];

        // send response back
        return self::$summary;
    }
}