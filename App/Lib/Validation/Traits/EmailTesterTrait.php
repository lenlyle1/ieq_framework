<?php

namespace App\Lib\Validation\Traits;

use \App\Lib\Utils\Debugger;

trait EmailTesterTrait
{
    public function testEmail($email)
    {
        $result = filter_var($email, FILTER_VALIDATE_EMAIL);
        // Debugger::debug($result);
        if (!$result) {
            $this->errors['email_address'][] = "Invalid email format";
            return false;
        }
    }
}