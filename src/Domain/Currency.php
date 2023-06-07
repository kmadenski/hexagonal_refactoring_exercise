<?php

namespace App\Domain;

use App\Shared\Domain\ValueObject\StringValueObject;

class Currency extends StringValueObject
{
    public function isEUR(): bool{
        return $this->value() === 'EUR';
    }
}
