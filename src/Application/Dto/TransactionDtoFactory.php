<?php

namespace App\Application\Dto;

use App\Application\Dto\TransactionDto;

class TransactionDtoFactory
{
    public static function create($rowTransaction): TransactionDto{
        $dto = new TransactionDto();
        $json = json_decode($rowTransaction);
        $dto->amount = $json->amount;
        $dto->bin = $json->bin;
        $dto->currency = $json->currency;

        return $dto;
    }
}
