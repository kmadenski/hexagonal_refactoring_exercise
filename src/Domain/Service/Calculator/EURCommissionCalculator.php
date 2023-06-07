<?php

namespace App\Domain\Service\Calculator;

use App\Domain\Amount;
use App\Domain\CommissionRate;
use App\Domain\Commission;
use App\Domain\Service\CommissionCalculatorInterface;
use App\Domain\Service\RoundService;

class EURCommissionCalculator implements CommissionCalculatorInterface
{
    private readonly Amount $baseAmount;
    private readonly CommissionRate $commissionRate;

    /**
     * @param Amount $baseAmount
     * @param CommissionRate $commissionRate
     */
    public function __construct(Amount $baseAmount, CommissionRate $commissionRate)
    {
        $this->baseAmount = $baseAmount;
        $this->commissionRate = $commissionRate;
    }

    public function commission(): Commission
    {
        $commissionFixed = RoundService::round($this->baseAmount->value() * $this->commissionRate->value());
        return new Commission($commissionFixed);
    }
}
