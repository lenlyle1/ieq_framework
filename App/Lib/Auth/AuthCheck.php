<?php

namespace App\Lib\Auth;

class AuthCheck
{
    public static function check()
    {
        return isset($_SESSION['user']);
    }
}
