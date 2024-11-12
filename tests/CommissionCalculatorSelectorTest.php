<?php

namespace Tests;

use App\Domain\Alpha2;
use App\Domain\Amount;
use App\Domain\Bin;
use App\Domain\CurrencyRate;
use App\Domain\Currency;
use App\Domain\Service\CommissionCalculatorSelector;
use App\Domain\Service\CurrencyRateProviderInterface;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class CommissionCalculatorSelectorTest extends TestCase
{
    #[DataProvider('commissionCalculationProvider')]
    public function testCalculation(string $alpha2, string $amount, string $currency, float $expected): void
    {
        // Create a mock for the CurrencyRateProviderInterface
        $currencyRateProvider = $this->getMockBuilder(CurrencyRateProviderInterface::class)
            ->getMock();

        // Configure the mock to return predefined currency rates
        $currencyRateProvider->expects($this->any())
            ->method('getRate')
            ->willReturnCallback(function (Currency $currency) {
                $mockCurrencyRates = [
                    'EUR' => 1.0,
                    'USD' => 1.06865,
                    'JPY' => 149.069171,
                    'GBP' => 0.86077,
                ];

                $currencyCode = $currency->value();

                if (!array_key_exists($currencyCode, $mockCurrencyRates)) {
                    throw new \Exception("Unexpected currency {$currencyCode}");
                }

                return new CurrencyRate($mockCurrencyRates[$currencyCode]);
            });

        $commissionCalculatorSelector = new CommissionCalculatorSelector($currencyRateProvider);

        // Calculate the commission
        $commission = ($commissionCalculatorSelector->getCalculator(
            new Bin(new Alpha2($alpha2)),
            new Currency($currency),
            new Amount($amount)
        ))->commission();

        // Assert that the calculated commission matches the expected value
        $this->assertEquals($expected, $commission->value());
    }

    public static function commissionCalculationProvider(): array
    {
        return [
            ['DK', '100.00', 'EUR', 2.0],
            ['LT', '50', 'USD', 0.94],
            ['JP', '10000', 'JPY', 1.34],
            ['US', '130', 'USD', 2.43],
            ['GB', '2000', 'GBP', 46.47],
        ];
    }
}
