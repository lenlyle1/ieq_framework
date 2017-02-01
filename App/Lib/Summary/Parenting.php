<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;

class Parenting extends Summary
{
    public static function getSummary($childId)
    {
        $assessment = self::getAssessment($childId);

        /*----------------------------------------------------------------------
        |   Improve behavior score
        ----------------------------------------------------------------------*/
        $improveBehaviorScore = self::calcScore([
            $assessment->child_good_job,
            $assessment->child_reward,
            $assessment->child_compliment,
            $assessment->child_praise,
            $assessment->child_hug,
            $assessment->child_help
        ]);

        if ($improveBehaviorScore !== null) {
            if ($improveBehaviorScore <= 2.16) {
                $color = 'red';
                $text = "You reported infrequent use of positive parenting strategies.";
            } else if (($improveBehaviorScore >= 2.17) && ($improveBehaviorScore <= 2.83)) {
                $color = 'yellow';
                $text = "You reported using some positive parenting strategies and may benefit from increasing this parenting skill.";
            } else if ($improveBehaviorScore >= 2.84) {
                $color = 'green';
                $text = "Giving your child encouragement & praise is a strength.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['improve_behavior'] = [
            'color' => $color,
            'text'  => $text
        ];

        /*----------------------------------------------------------------------
        |   Monitor peer score
        ----------------------------------------------------------------------*/
        $monitorPeersScore = self::calcScore([
            $assessment->free_time,
            $assessment->hangs_out,
            $assessment->where_friends,
            $assessment->after_school,
            $assessment->when_away,
            $assessment->coming_day,
            $assessment->child_activities,
            $assessment->unsupervised_often
        ]);

        if ($monitorPeersScore !== null) {
            if ($monitorPeersScore >= 0.81) {
                $color = 'red';
                $text = "You reported not knowing your children’s friends very well or how they spend time with your child.  You may want to use parenting strategies provided to improve this skill.";
            } else if (($monitorPeersScore >= 0.5) && ($monitorPeersScore <= 0.8)) {
                $color = 'yellow';
                $text = "There is room to strengthen your monitoring of your child's friends and activities when you are not present.";
            } else if ($monitorPeersScore <= 0.49) {
                $color = 'green';
                $text = "You reported knowing a lot about your child’s friends and how they spend time together. ";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['monitor_peers'] = [
            'color' => $color,
            'text'  => $text
        ];

        /*----------------------------------------------------------------------
        |   Monitor school score
        ----------------------------------------------------------------------*/
        $monitorSchoolScore = self::calcScore([
            $assessment->on_time,
            $assessment->check_needs,
            $assessment->check_homework,
            $assessment->check_day
        ]);

        if ($monitorSchoolScore !== null) {
            if ($monitorSchoolScore <= 2.42) {
                $color = 'red';
                $text = "You reported infrequent monitoring of your child’ school success. You might consider increasing your attention and parenting support in this area.";
            } else if (($monitorSchoolScore >= 2.43) && ($monitorSchoolScore <= 2.85)) {
                $color = 'yellow';
                $text = "Based on your report, you could increase the amount you are monitoring your child’s school success. ";
            } else if ($monitorSchoolScore <= 2.86) {
                $color = 'green';
                $text = "You reported a high level of monitoring and knowledge about your student’s school success.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['monitor_school'] = [
            'color' => $color,
            'text'  => $text
        ];

        /*----------------------------------------------------------------------
        |   Set limits score
        ----------------------------------------------------------------------*/
        $setLimitsScore = self::calcScore([
            $assessment->speak_calmly,
            $assessment->stick_rules,
            $assessment->explain_simple,
            $assessment->dont_like,
            $assessment->expected_behavior,
            $assessment->enforce_behavior,
            $assessment->follow_rules
        ]);

        if ($setLimitsScore !== null) {
            if ($setLimitsScore <= 2.42) {
                $color = 'red';
                $text = "You reported infrequent or inconsistent limit setting. Your scores indicate it may be a challenge for you to set limits, and/or to follow through.";
            } else if (($setLimitsScore >= 2.43) && ($setLimitsScore <= 2.85)) {
                $color = 'yellow';
                $text = "You reported setting limits with your child, but may improve your consistency and the way you follow through with these rules.";
            } else if ($setLimitsScore <= 2.86) {
                $color = 'green';
                $text = "Your scores indicate that you set limits regularly and consistently and that you follow-through with your expectations.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['set_limits'] = [
            'color' => $color,
            'text'  => $text
        ];

        /*----------------------------------------------------------------------
        |   Parent school score
        ----------------------------------------------------------------------*/
        $parentSchoolScore = self::calcScore([
            $assessment->talk_teachers,
            $assessment->special_visit,
            $assessment->open_house,
            $assessment->wecome_visit,
            $assessment->enjoy_teachers,
            $assessment->teachers_care,
            $assessment->teachers_know
        ]);

        if ($parentSchoolScore !== null) {
            if ($parentSchoolScore <= 1.7) {
                $color = 'red';
                $text = "You reported very little connection with your child’s school or teachers. You might consider finding ways to improve communication and relationships with your child’s school and teachers.";
            } else if (($parentSchoolScore >= 1.71) && ($parentSchoolScore <= 2.70)) {
                $color = 'yellow';
                $text = "Your scores indicate some communication with your child’s school and teachers. You may wish to look for ways to increase your connection.";
            } else if ($parentSchoolScore <= 2.71) {
                $color = 'green';
                $text = "Your scores indicate that you communicate regularly with your child's school and teachers. This is a parenting strength! Work to maintain these connections through high school.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['parent_school'] = [
            'color' => $color,
            'text'  => $text
        ];

        // send response back
        return self::$summary;
    }
}