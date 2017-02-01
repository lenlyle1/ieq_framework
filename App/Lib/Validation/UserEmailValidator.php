<?php

namespace App\Lib\Validation;

use \App\Lib\Utils\Debugger;

class UserEmailValidator extends Validation
{
    public function validate($email)
    {
        // check email in db
        if (!$email) {
            $this->errors['email'][] = 'Please enter an email';
        }

        if($email && !$user = $this->fieldInDb('UserContactInformation', 'email_address', $email)){
            $this->errors['email'][] = 'Email not registered, please check and try again';
        }

        if ($this->errors) {
            return [
                'success' => false,
                'errors' => $this->errors
            ];
        } else {
            return [
                'success' => true,
                'user' => $user
            ];
        }
    }
}