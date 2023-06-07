<?php

namespace App\Infrastructure;

use App\Domain\Alpha2;
use App\Domain\Bin;

class BinFactory
{
    public static function create(\stdClass $binResults): Bin
    {
        $alpha2 = new Alpha2($binResults->country->alpha2);
        return new Bin($alpha2);
    }
}
