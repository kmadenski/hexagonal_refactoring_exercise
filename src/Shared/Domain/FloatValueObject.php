<?php

namespace App\Shared\Domain\ValueObject;

abstract class FloatValueObject
{
    protected readonly float $value;

    public function __construct(float $value)
    {
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}
