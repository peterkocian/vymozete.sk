<?php

namespace App\Helpers;

class Utils
{
    public static function twoDecimal($value)
    {
        return number_format((float)$value, 2, ',', '');
    }
}
