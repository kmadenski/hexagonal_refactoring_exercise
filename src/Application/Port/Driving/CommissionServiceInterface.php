<?php

namespace App\Application\Port\Driving;

use App\Domain\Commission;
use App\Application\Dto\TransactionDto;

interface CommissionServiceInterface
{
    public function handle(TransactionDto $transactionDto): Commission;
}
