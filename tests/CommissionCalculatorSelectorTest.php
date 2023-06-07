<?php

namespace Tests;

use App\Domain\Alpha2;
use App\Domain\Amount;
use App\Domain\Bin;
use App\Domain\CurrencyRate;
use App\Domain\Currency;
use App\Domain\Service\CommissionCalculatorSelector;
use App\Domain\Service\CurrencyRateProviderInterface;
use PHPUnit\Framework\TestCase;

final class CommissionCalculatorSelectorTest extends TestCase
{
    public function testCalculation(): void
    {
        $currencyRateProvider = $this->getMockBuilder(CurrencyRateProviderInterface::class)
            ->getMock();

        $currencyRateProvider->expects($this->any())
            ->method('getRate')
            ->will($this->returnCallback(function (Currency $currency){
                $mockCurrencyRates = [
                    'EUR' => 1,
                    'USD' => 1.06865,
                    'JPY' => 149.069171,
                    'GBP' => 0.86077
                ];

                if(!array_key_exists($currency->value(), $mockCurrencyRates)){
                    throw new \Exception("Unexpected currency {$currency->value()}");
                }

                return new CurrencyRate($mockCurrencyRates[$currency->value()]);
            }));

        $commissionCalculatorSelector = new CommissionCalculatorSelector($currencyRateProvider);

        $cases = [
            [
                "alpha2" => "DK",
                "amount" => "100.00",
                "currency" => "EUR",
                'expected' => 2
            ],
            [
                "alpha2" => "LT",
                "amount" => "50",
                "currency" => "USD",
                'expected' => 0.94
            ],
            [
                "alpha2" => "JP",
                "amount" => "10000",
                "currency" => "JPY",
                'expected' => 1.34
            ],
            [
                "alpha2" => "US",
                "amount" => "130",
                "currency" => "USD",
                'expected' => 2.43
            ],
            [
                "alpha2" => "GB",
                "amount" => "2000",
                "currency" => "GBP",
                'expected' => 46.47
            ]
        ];

        foreach ($cases as $case) {
            $commission = ($commissionCalculatorSelector->getCalculator(
                (new Bin(new Alpha2($case['alpha2']))),
                (new Currency($case['currency'])),
                (new Amount($case['amount']))
            ))->commission();

            $this->assertEquals($case['expected'], $commission->value());
        }
    }
}
