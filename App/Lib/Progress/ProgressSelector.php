<?php

namespace App\Lib\Progress;

use \App\Lib\Utils\Debugger;

class ProgressSelector
{
    public static function select($progress)
    {
        //Debugger::debug('Selecting progress');
        $progress = array_reverse((array) $progress);

        Debugger::debug($progress);

        if ($progress['viewed_skills_home'] == 1) {
            return '/skills-home';
        } else if ($progress['viewed_assessment_results'] == 1) {
            return '/all-scores';
        } else if ($progress['viewed_assessment'] > 0) {
            return '/assessment/' . $progress['viewed_assessment'];
        } else {
            return '/child-start';
        }

        // foreach ($progress as $key => $value) {
        //     if ($value == 1) {
        //         $page = preg_replace('/viewed\_|finished\_/', '', $key);
        //         Debugger::debug('Last page = ' . $page);
        //         switch($page) {
        //             case 'assessment':
        //                 return '/assessment/1';
        //             case 'assessment_results':
        //                 return '/all-scores';
        //             case 'skills_home':
        //                 return '/skills-home';
        //             default:
        //                 return '/child-start';

        //         }
        //     }
        // }

        // if(!empty($progress['viewed_skills_home']) && $progress['viewed_skills_home'] == 1 && $_SESSION['child_id']){
        //     return 'skills-home';
        // } else {
        //     return 'child-start';
        // }
    }

    public static function getSkillsProgress($progress)
    {
        return [
            'positiveParenting' => [
                'started' => self::testStarted('positiveParenting', $progress),
                'completed' => self::testCompleted('positiveParenting', $progress)
            ],
            'setLimits' => [
                'started' => self::testStarted('setLimits', $progress),
                'completed' => self::testCompleted('setLimits', $progress)
            ],
            'monitoring' => [
                'started' => self::testStarted('monitoring', $progress),
                'completed' => self::testCompleted('monitoring', $progress)
            ],
            'openCommunication' => [
                'started' => self::testStarted('openCommunication', $progress),
                'completed' => self::testCompleted('openCommunication', $progress)
            ],
        ];
    }

    public static function positiveParentingViews($progress)
    {
        return [
            'viewed_encouragement_1',
            'viewed_encouragement_2',
            'viewed_directions_1',
            'viewed_directions_2',
            'viewed_directions_3',
            'viewed_use_rewards_1',
            'viewed_use_rewards_2',
            'viewed_positive_parenting_summary',
            'viewed_positive_parenting_practice'
        ];
    }

    public static function setLimitsViews($progress)
    {
        return [
            'viewed_clear_rules_1',
            'viewed_clear_rules_2',
            'viewed_consequences_1',
            'viewed_consequences_2',
            'viewed_consequences_3',
            'viewed_challenges_1',
            'viewed_challenges_2',
            'viewed_set_limits_summary',
            'viewed_set_limits_practice'
        ];
    }

    public static function monitoringViews($progress)
    {
        return [
            'viewed_monitor_1',
            'viewed_monitor_2',
            'viewed_monitor_3',
            'viewed_school_success_1',
            'viewed_school_success_2',
            'viewed_school_success_3',
            'viewed_school_success_4',
            'viewed_school_success_summary',
            'viewed_school_success_practice'
        ];

    }

    public static function openCommunicationViews($progress)
    {
        return [
            'viewed_listening_1',
            'viewed_listening_2',
            'viewed_listening_3',
            'viewed_listening_4',
            'viewed_meetings_1',
            'viewed_meetings_2',
            'viewed_meetings_3',
            'viewed_meetings_summary',
            'viewed_meetings_practice'
        ];

    }

    private static function testStarted($section, $progress)
    {
        $views = self::{$section . 'Views'}($progress);

        foreach ($views as $view) {
            if($progress->$view == 1){
                // Debugger::debug($view . ':' . $progress->$view, 'failed progress');
                return true;
            }
        }

        return false;
    }

    private static function testCompleted($section, $progress)
    {
        $views = self::{$section . 'Views'}($progress);

        foreach ($views as $view) {
            if($progress->$view != 1){
                // Debugger::debug($view . ':' . $progress->$view, 'failed progress');
                return false;
            }
        }

        return true;
    }

}