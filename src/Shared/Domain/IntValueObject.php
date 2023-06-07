<?php

namespace App\Shared\Domain\ValueObject;

abstract class IntValueObject
{
    protected readonly int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
