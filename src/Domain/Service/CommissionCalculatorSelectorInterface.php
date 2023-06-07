<?php

namespace App\Domain\Service;

use App\Domain\Amount;
use App\Domain\Bin;
use App\Domain\Currency;

interface CommissionCalculatorSelectorInterface
{
    public function getCalculator(Bin $bin, Currency $currency, Amount $amount): CommissionCalculatorInterface;

}
