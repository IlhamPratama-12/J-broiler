<?php

namespace App\Helpers;

class NumberHelper
{
    public static function numberFormat(float $num, int $decimals = 2, bool $alwaysDecimal = false): string
    {
        $floor = floor($num);
        return number_format($num, ((!$alwaysDecimal) && ($floor == $num) ? 0 : $decimals), ',', '.');
    }
}
