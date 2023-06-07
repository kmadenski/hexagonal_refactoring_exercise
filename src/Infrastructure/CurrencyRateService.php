<?php

namespace App\Infrastructure;

use App\Domain\CurrencyRate;
use App\Domain\Currency;
use App\Application\Port\Driven\CurrencyRateProviderInterface;

class CurrencyRateService implements CurrencyRateProviderInterface
{
    public function getRate(Currency $currency): CurrencyRate
    {
        $token = $_ENV['EXCHANGERATESAPI_TOKEN'];
        $rates = file_get_contents("http://api.exchangeratesapi.io/latest?access_key={$token}");
        if (!$rates){
            throw new \Exception("Exchangeratesapi cannot retrieve data for {$currency->value()}");
        }

        $rate = json_decode($rates, true)['rates'][$currency->value()];
        return new CurrencyRate($rate);
    }

}
