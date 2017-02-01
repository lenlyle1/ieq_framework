<?php

namespace Lib\Debug\Traits;

trait DebuggerWritelogTrait
{
    public static function writelog($file, $message)
    {
        //echo 'here ';
        if(!IS_LIVE){
            error_log($message, 3, $file . ".log");
        }
    }
}