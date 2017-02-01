<?php

namespace App\Lib\Validation;

use \App\Lib\Utils\Debugger;

class UserValidation extends Validation
{
    public function validate($params)
    {
        $requiredFields = [
            'first_name',
            'last_name',
            'time_zone',
            'email_address',
            'username',
            'password',
            'confirm_password'
        ];

        // check required fields filled
        foreach ($requiredFields as $field) {
            if(!$this->notEmpty($params[$field])){
                $this->setError($field, $this->formatFieldName($field) . ' is required');
            }
        }

        // check for phone number
        if ($params['home_phone'] == '' && $params['mobile_phone'] == '') {
            $this->setError('phone', 'At least one phone number is required');
        }

        // check username not subscribed
        if ($this->fieldInDb('UserProfile', 'username', $params['username'])) {
            $this->errors['username'][] = 'Username already subscribed';
        }

        // check email valid and not subscribed
        if($params['email_address'] != ''){
            if ($this->testEmail($params['email_address'])){
                $this->errors['email_address'][] = 'Invalid Email Address';
            }
            if ($this->fieldInDb('UserContactInformation', 'email_address', $params['email_address'])) {
                $this->errors['email_address'][] = 'Email already subscribed';
            }
        }

        if ($params['password'] != $params['confirm_password']) {
            $this->setError('password_confirm', 'Passwords do not match');
        }

        if ($this->errors) {
            return [
                'success' => false,
                'errors' => $this->errors
            ];
        } else {
            return [
                'success' => true
            ];
        }



    }
}