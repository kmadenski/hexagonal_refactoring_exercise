<?php

namespace App\Domain\Service;

use App\Domain\Commission;

interface CommissionCalculatorInterface
{
    public function commission(): Commission;
}
