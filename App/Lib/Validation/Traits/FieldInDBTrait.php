<?php

namespace App\Lib\Validation\Traits;

use \App\Lib\Utils\Debugger;

trait FieldInDBTrait
{
    public function fieldInDb($modelName, $fieldName, $value)
    {
        $modelName = '\\App\\Models\\' . $modelName;
        $model = new $modelName();

        return $model->getOne($fieldName, $value);

        /*if ($found) {
            $this->errors[$fieldName][] = self::formatFieldName($fieldName) . ' already subscribed';
        }*/
    }
}