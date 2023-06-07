<?php

namespace App\Application;

use App\Application\Port\Driving\CommissionServiceInterface;
use App\Application\Port\Driven\BinProviderInterface;
use App\Domain\Amount;
use App\Domain\BinRef;
use App\Domain\Commission;
use App\Domain\Currency;
use App\Application\Dto\TransactionDto;
use App\Domain\Service\CommissionCalculatorSelectorInterface;

class CommissionService implements CommissionServiceInterface
{
    private BinProviderInterface $binProvider;
    private CommissionCalculatorSelectorInterface $calculatorSelector;

    /**
     * @param BinProviderInterface $binProvider
     * @param CommissionCalculatorSelectorInterface $calculatorSelector
     */
    public function __construct(BinProviderInterface $binProvider, CommissionCalculatorSelectorInterface $calculatorSelector)
    {
        $this->binProvider = $binProvider;
        $this->calculatorSelector = $calculatorSelector;
    }


    public function handle(TransactionDto $transactionDto): Commission
    {
        $baseCurrency = new Currency($transactionDto->currency);
        $baseAmount = new Amount($transactionDto->amount);
        $binRef = new BinRef($transactionDto->bin);
        $bin = $this->binProvider->findOneBy($binRef);
        $calculator = $this->calculatorSelector->getCalculator($bin, $baseCurrency, $baseAmount);
        return $calculator->commission();
    }
}
