<?php

namespace App\Domain\Service;

use App\Domain\CurrencyRate;
use App\Domain\Currency;

interface CurrencyRateProviderInterface
{
    public function getRate(Currency $currency): CurrencyRate;
}
