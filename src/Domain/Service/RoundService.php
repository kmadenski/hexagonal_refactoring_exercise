<?php

namespace App\Domain\Service;

use App\Domain\Amount;

class RoundService
{
    public static function round(float $value): float{
        //@todo money brick probably better
        return round($value, 2);
    }
}
