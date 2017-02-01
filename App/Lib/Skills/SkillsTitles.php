<?php

namespace App\Lib\Skills;

use \App\Lib\Utils\Debugger;

class SkillsTitles extends Skills
{
    public static function load()
    {
        return self::$titles;
    }
}