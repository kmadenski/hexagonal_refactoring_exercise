<?php

namespace App\Shared\Domain\ValueObject;

abstract class StringValueObject
{
    protected readonly string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
