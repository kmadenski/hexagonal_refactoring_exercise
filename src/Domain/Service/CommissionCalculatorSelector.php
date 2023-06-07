<?php

namespace App\Domain\Service;

use App\Domain\Amount;
use App\Domain\Bin;
use App\Domain\Commission;
use App\Domain\Currency;
use App\Domain\Service\Calculator\EURCommissionCalculator;
use App\Domain\Service\Calculator\NonEURCommissionCalculator;

class CommissionCalculatorSelector implements CommissionCalculatorSelectorInterface
{
    private CurrencyRateProviderInterface $currencyRateProvider;

    /**
     * @param CurrencyRateProviderInterface $currencyRateProvider
     */
    public function __construct(CurrencyRateProviderInterface $currencyRateProvider)
    {
        $this->currencyRateProvider = $currencyRateProvider;
    }


    public function getCalculator(Bin $bin, Currency $currency, Amount $amount): CommissionCalculatorInterface
    {
        $commissionRate = $bin->isEu() ? CommissionRateProvider::getEuRate() : CommissionRateProvider::getNonEuRate();

        if($currency->isEUR()){
            $calculator = new EURCommissionCalculator(
                $amount,
                $commissionRate
            );
        }else{
            $currencyRate = $this->currencyRateProvider->getRate($currency);
            $calculator = new NonEURCommissionCalculator(
                $amount,
                $commissionRate,
                $currencyRate
            );
        }

        return $calculator;
    }


}
