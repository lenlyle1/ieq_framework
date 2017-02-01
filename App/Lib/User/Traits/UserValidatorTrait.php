<?php

namespace App\Lib\User;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;
use \Respect\Validation\Validator as v;
use \Respect\Validation\Exceptions\NestedValidationException;


class UserValidatorTrait
{
    public static function validate($username, $password)
    {
        $userDetails = new \stdClass();
        $userDetails->username = $request->getParam('username');
        $userDetails->password = $request->getParam('password');

        $userValidator = v::attribute('username', v::notEmpty()->alpha()->length(6,32))->UsernameAvailable()
                          ->attribute('password', v::notEmpty());

        try {
            $userValidator->assert($userDetails);
            if ($user = UserLoadByUsername::load($request->getParam('username'))) {
                return ['success' => false,
                        'errors' => ['username' => 'Username already subscribed']];
            }
        } catch(NestedValidationException $exception) {
            return ['success' => false,
                    'errors' => $exception->findMessages(['username', 'password'])];
        }
    }
}