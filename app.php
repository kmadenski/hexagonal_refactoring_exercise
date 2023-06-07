<?php

use App\Application\CommissionAdapter;

include_once "vendor/autoload.php";

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$currencyRateProvider = new \App\Infrastructure\CurrencyRateService();
$calculatorSelector = new \App\Domain\Service\CommissionCalculatorSelector($currencyRateProvider);
$binProvider = new \App\Infrastructure\BinProvider();
$commissionService = new \App\Application\CommissionService($binProvider,$calculatorSelector);
$adapter = new CommissionAdapter($commissionService);

$adapter($argv[1]);
