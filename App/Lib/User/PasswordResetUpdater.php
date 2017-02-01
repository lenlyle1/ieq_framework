<?php

namespace App\Lib\User;

use \App\Lib\Validation\UserEmailValidator;
use \App\Lib\Mailer\SendMail;
use \App\Lib\Utils\Debugger;
use \App\Models\UserProfile;

class PasswordResetUpdater
{
    public static function update($params)
    {
        if(empty($params['password'])){
            return [
                'error' => 'Password cannot be empty!',
                'success' => false,
            ];
        }

        $userModel = new UserProfile();

        $user = $userModel->getOne('reset_token', $params['token']);

        if ($user) {

            Debugger::debug($params);
            if($params['password'] !== $params['confirm_password']){
                return [
                    'error' => 'Passwords do not match!',
                    'success' => false,
                ];
            }

            $userModel->setValues([
                'user_profile_id' => $user->user_profile_id,
                'password' => password_hash($params['password'], PASSWORD_DEFAULT),
                'reset_token' => null,
                'token_time' => null
            ]);

            $userModel->save();

            if ($tokenDate < $dateNow){
                return [
                    'success' => false,
                    'error' => 'Token has expired!  <a href="/user/password-reset-form">Click here</a> to request a new one'
                ];
            }
            return [
                'success' => true,
                'user_profile_id' => $user->user_profile_id,
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