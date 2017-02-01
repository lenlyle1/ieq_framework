<?php

namespace App\Lib\Auth;

use \App\Lib\User\UserLoadByUsername;
use \App\Lib\Utils\Debugger;
use \App\Lib\Progress\ProgressLoader;

class AuthAttempt
{
    public static function attempt($username, $password)
    {
        $user = UserLoadByUsername::load($username);

        if ( ! $user) {
            Debugger::debug('User not loaded');
            return false;
        }

        # Verify password for user:
        if (password_verify($password, $user->password)) {
            Debugger::debug('Loading progress');
            # Set user into current session:
            $_SESSION['user'] = $user->user_profile_id;

            $_SESSION['user_progress'] = ProgressLoader::load($user->user_profile_id);

            return true;
        }

        return false;
    }
}
