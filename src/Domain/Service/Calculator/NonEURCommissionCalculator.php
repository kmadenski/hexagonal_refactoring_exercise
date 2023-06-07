<?php

namespace App\Domain\Service\Calculator;

use App\Domain\Amount;
use App\Domain\CommissionRate;
use App\Domain\Commission;
use App\Domain\CurrencyRate;
use App\Domain\Service\CommissionCalculatorInterface;
use App\Domain\Service\RoundService;

class NonEURCommissionCalculator implements CommissionCalculatorInterface
{
    private readonly Amount $baseAmount;
    private readonly CommissionRate $commissionRate;
    private readonly CurrencyRate $currencyRate;

    /**
     * @param Amount $baseAmount
     * @param CommissionRate $commissionRate
     * @param CurrencyRate $currencyRate
     */
    public function __construct(Amount $baseAmount, CommissionRate $commissionRate, CurrencyRate $currencyRate)
    {
        $this->baseAmount = $baseAmount;
        $this->commissionRate = $commissionRate;
        $this->currencyRate = $currencyRate;
    }


    public function commission(): Commission
    {
        $baseAmount = $this->baseAmount->value() / $this->currencyRate->value();

        $commissionFixed = RoundService::round($baseAmount * $this->commissionRate->value());
        return new Commission($commissionFixed);
    }
}
