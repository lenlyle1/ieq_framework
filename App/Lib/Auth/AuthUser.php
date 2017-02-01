<?php

namespace App\Lib\Auth;

use \App\Lib\User\UserLoadById;

class AuthUser
{
    public function user()
    {
        return AuthCheck::check() ? UserLoadById::load($_SESSION['user']) : '';
    }
}
