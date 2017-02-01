<?php

namespace App\Lib\Validation\Traits;

trait FormattingTrait
{
    public function formatFieldName($fieldName)
    {
        return str_replace('_', ' ', ucwords($fieldName));
    }
}