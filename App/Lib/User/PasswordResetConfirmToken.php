<?php

namespace App\Lib\User;

use \App\Lib\Validation\UserEmailValidator;
use \App\Lib\Mailer\SendMail;
use \App\Lib\Utils\Debugger;
use \App\Models\UserProfile;

class PasswordResetConfirmToken
{
    public static function confirm($token)
    {
        $userModel = new UserProfile();

        $user = $userModel->getOne('reset_token', $token);

        if ($user) {
            // check token not expired
            $tokenDate = new \DateTime($user->token_time);
            $tokenDate->add(new \DateInterval('P1D'));

            $dateNow = new \DateTime("now");

            if ($tokenDate < $dateNow){
                return [
                    'success' => false,
                    'error' => 'Token has expired!  <a href="/user/password-reset-form">Click here</a> to request a new one'
                ];
            }
            return [
                'success' => true,
                'user' => $user,
                'error' => null
            ];
        } else {
            return [
                'success' => false,
                'error' => 'Invalid token'
            ];
        }
    }
}