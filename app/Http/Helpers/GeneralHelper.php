<?php

namespace App\Http\Helpers;

class GeneralHelper
{
    public static function view(...$args)
    {
       return implode(".",$args);
    }
}