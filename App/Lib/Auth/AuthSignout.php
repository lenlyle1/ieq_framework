<?php

namespace App\Lib\Auth;

class AuthSignout
{
    public static function signout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['child_id']);
        unset($_SESSION['user_progress']);
        unset($_SESSION['csrf']);
    }
}
