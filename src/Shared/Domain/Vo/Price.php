<?php

declare(strict_types=1);

namespace App\Shared\Domain\Vo;

class Price
{
    protected function __construct(private readonly int $value)
    {
    }

    /**
     * @param int $value
     * @return static
     */
    public static function from(int $value) : self
    {
        return new static($value);
    }

    public function value() : int
    {
        return $this->value;
    }

    public function is(self $other) : bool
    {
        return $this->value === $other->value;
    }

    public function isNot(self $other) : bool
    {
        return !$this->is($other);
    }
}
