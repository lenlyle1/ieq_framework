<?php

namespace App\Lib\Summary;

use \App\Lib\Utils\Debugger;

class Behaviors extends Summary
{
    public static function getSummary($childId)
    {
        $assessment = self::getAssessment($childId);

        /*----------------------------------------------------------------------
        |   Behavior at home score
        ----------------------------------------------------------------------*/
        $behaviorScore = self::calcScore([
            $assessment->loses_temper,
            $assessment->well_behaved,
            $assessment->fights_others,
            $assessment->lies_cheats,
            $assessment->steals_home
        ]);

        if ($behaviorScore !== null) {
            if ($behaviorScore >= 0.8) {
                $color = 'red';
                $text = "Based on your results, your child’s behavior at home falls in the “serious concern” category.";
            } else if (($behaviorScore >= 0.6) && ($behaviorScore <= 0.79)) {
                $color = 'yellow';
                $text = "You reported some concerns about your child's behavior at home. Practicing new parenting skills may reduce behavior problems at home.";
            } else if ($behaviorScore <= 0.59) {
                $color = 'green';
                $text = "You reported few to no concerns about your child’s behavior at home. Positive child behavior at home is a strength for your family.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['behavior_at_home'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |   Substance use score
        ----------------------------------------------------------------------*/
        $substanceScore = self::calcScore([
            $assessment->use_drugs
        ]);

        if ($substanceScore !== null) {
            if ($substanceScore == 1) {
                $color = 'red';
                $text ="Any drug or alcohol use at your child’s age is considered a serious concern that needs to be addressed. Attention to this area is an area of critical importance to your child's well-being.";
            } else if ($substanceScore== 0) {
                $color = 'green';
                $text = "You reported your child isn’t using any substances at this time and that is a strength for your child.  Continue to use effective parenting strategies to prevent substance use as your child moves towards high school.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['substance_use'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |   Emotional well being score
        ----------------------------------------------------------------------*/
        $emotionalScore = self::calcScore([
            $assessment->often_complains,
            $assessment->many_worries,
            $assessment->often_unhappy,
            $assessment->easily_scared
        ]);

        if ($emotionalScore !== null) {
            if ($emotionalScore >= 1) {
                $color = 'red';
                $text = "Your child’s mood falls in the serious concern category. Consider seeking professional consultation and support.";
            } else if (($emotionalScore >= 0.8) && ($emotionalScore <= 0.99)) {
                $color = 'yellow';
                $text = "Your results suggest your child's emotional well-being may be a concern. Using the FCU parenting strategies may help improve your child’s emotional well-being.";
            } else if ($emotionalScore <= 0.79) {
                $color = 'green';
                $text = "Your child appears to have a stable and positive outlook. Your child’s positive mood is a strength.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['emotional_well_being'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |  Peer relationships score
        ----------------------------------------------------------------------*/
        $peerRelationsipsScore = self::calcScore([
            $assessment->friends_behave,
            $assessment->friends_misbehave,
            $assessment->friends_experiment,
            $assessment->friends_gang
        ]);
        if ($peerRelationsipsScore !== null) {
            if ($peerRelationsipsScore >= 0.81) {
                $color = 'red';
                $text = "Your results indicate that your child’s friends are not behaving well. Focus on monitoring this key area and work to decrease unsupervised access to problem peers.";
            } else if (($peerRelationsipsScore >= 0.5) && ($peerRelationsipsScore <= 0.8)) {
                $color = 'yellow';
                $text = "Your results indicate some concerns regarding your child's friends. ";
            } else if ($peerRelationsipsScore <= 0.49) {
                $color = 'green';
                $text = "Your child's friends appear to be well behaved. ";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['peer_relationships'] = [
            'color' => $color,
            'text'  => $text
        ];


        /*----------------------------------------------------------------------
        |   Self management score
        ----------------------------------------------------------------------*/
        $selfManagementScore = self::calcScore([
            $assessment->project_due,
            $assessment->easy_concentrate,
            $assessment->keeping_track,
            $assessment->close_attention,
            $assessment->stick_goals
        ]);

        if ($selfManagementScore !== null) {
            if ($selfManagementScore <= 2.11){
                $color = 'red';
                $text = "Your scores indicate your child may be struggling with self-management skills and may need more support, teaching, and encouragement to develop these important skills.";
            } else if (($selfManagementScore >= 2.12) && ($selfManagementScore <= 2.86)) {
                $color = 'yellow';
                $text = "There are some gaps in your child's ability to manage activities at home and at school.";
            } else if ($selfManagementScore >= 2.87) {
                $color = 'green';
                $text = "Your child shows well-developed skills in managing activities at home and at school.";
            }
        } else {
            $color = 'gray';
            $text = self::$grayText;
        }

        self::$summary['self_management'] = [
            'color' => $color,
            'text'  => $text
        ];

        // send response back
        return self::$summary;
    }
}
