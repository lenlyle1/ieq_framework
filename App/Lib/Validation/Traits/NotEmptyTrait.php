<?php

namespace App\Lib\Validation\Traits;

trait NotEmptyTrait
{
    protected function notEmpty($value)
    {
        if (empty($value)) {
            return false;
        }

        return true;
    }
}