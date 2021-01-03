<?php

namespace App\Helpers;

class Utils
{
    public static function twoDecimal($value): float
    {
        return number_format((float)$value, 2, '.', '');
    }
}
