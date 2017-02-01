<?php

namespace App\Lib\Validation;

use \App\Lib\Mysql;
use \App\Lib\Utils\Debugger;

abstract class Validation
{
    use Traits\FieldInDBTrait;
    use Traits\FormattingTrait;
    use Traits\NotEmptyTrait;
    use Traits\EmailTesterTrait;

    protected $errors = [];

    protected function setError($field, $error)
    {
        $this->errors[$field][] = $error;
    }
}