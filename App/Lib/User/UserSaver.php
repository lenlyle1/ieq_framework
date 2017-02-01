<?php

namespace App\Lib\User;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;
use \App\Models\UserProfile;
use \App\Models\UserContactInformation;
use \App\Lib\Validation\UserValidation;
use \App\Lib\Auth\AuthAttempt;

class UserSaver
{

    public static function signup($params)
    {

    }

    public static function save($params)
    {
        Debugger::debug($params);
        $validator = new UserValidation();
        $validationResult = $validator->validate($params);

        if (!$validationResult['success']) {
            Debugger::debug($validationResult, 'validation failed');
            return $validationResult;
        }

        unset($params['confirm_password']);
        $params['condition_id'] = 3;
        // hash the password
        //$params['password'] = password_hash($params['password'], PASSWORD_DEFAULT);

        Debugger::debug('inserting user_profile');
        // # Register the user with a placeholder condition id:
        $user = new UserProfile();

        $values = [
            'username' => $params['username'],
            'password' => password_hash($params['password'], PASSWORD_DEFAULT),
            'condition_id' => $params['condition_id'],
            'enroll_date' => date('Y-m-d')
        ];

        $user->setValues($values);
        $user->save();


        // get the new user_profile_id
        $userProfileId = AuthAttempt::attempt($params['username'], $params['password']);
        Debugger::debug($userProfileId, '$userProfileId');

        if ($userProfileId) {
            $userContact = new UserContactInformation();

            $values = [
                'user_profile_id' => $userProfileId,
                'first_name' => $params['first_name'],
                'last_name' => $params['last_name'],
                'address_line_1' => $params['address_line_1'],
                'address_line_2' => $params['address_line_2'],
                'city_name' => $params['city_name'],
                'state_id' => $params['state'],
                'postal_code' => $params['postal_code'],
                'home_phone' => $params['home_phone'],
                'mobile_phone' => $params['mobile_phone'],
                'email_address' => $params['email_address'],
                'time_zone_id' => $params['time_zone']
            ];

            $userContact->setValues($values);
            $userContact->save();
        }

        return ['success' => true,
                'user_profile_id' => $userProfileId];
    }
}