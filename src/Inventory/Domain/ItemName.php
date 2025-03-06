<?php

declare(strict_types=1);

namespace App\Inventory\Domain;



use App\Inventory\Domain\Exceptions\InvalidInventoryArgumentException;

final readonly class ItemName
{
    private string $value;

    private function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw InvalidInventoryArgumentException::invalidItemName();
        }

        $this->value = $value;
    }

    public static function isValid(string $value) : bool
    {
        return (bool) preg_match('/^[a-zA-Z0-9\s]{2,32}$/D', $value);
    }

    public static function make(string $value) : self
    {
        return new self(trim($value));
    }

    public function value() : string
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