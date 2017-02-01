<?php

namespace App\Lib\User;

use \App\Lib\Validation\UserEmailValidator;
use \App\Lib\Mailer\SendMail;
use \App\Lib\Utils\Debugger;

class PasswordResetCreateToken
{
    use Traits\CreateSingleUseTokenTrait;

    public static function send($email)
    {
        $validator = new UserEmailValidator();
        $validationResult = $validator->validate($email);

        if (!$validationResult['success']) {
            return $validationResult;
        }

        $userDetails = $validationResult['user'];

        // create the token
        $token = self::createToken(64);

        // save the token in the user
        $user = new \App\Models\UserProfile();
        $user->setValues([
            'user_profile_id' => $userDetails->user_profile_id,
            'reset_token' => $token,
            'token_time' => date("Y-m-d H:i:s")
        ]);
        $user->save();

        return [
            'success' => true,
            'user' => $userDetails,
            'token' => $token
        ];
    }
}