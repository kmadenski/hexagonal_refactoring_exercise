<?php

namespace App\Domain\Service;

use App\Domain\CommissionRate;

class CommissionRateProvider
{
    CONST EU_RATE = 0.01;
    CONST NON_EU_RATE = 0.02;
    public static function getEuRate(): CommissionRate
    {
        return new CommissionRate(self::EU_RATE);
    }

    public static function getNonEuRate(): CommissionRate
    {
        return new CommissionRate(self::NON_EU_RATE);
    }

}
