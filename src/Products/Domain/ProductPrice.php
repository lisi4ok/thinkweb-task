<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Products\Domain\Exceptions\InvalidProductArgumentException;
use App\Shared\Domain\Vo\Price;

final class ProductPrice extends Price
{
    private function __construct(int $value)
    {
        if (!self::isValid($value)) {
            throw InvalidProductArgumentException::invalidPriceValue();
        }
        parent::__construct($value);
    }

    public static function isValid(int $value) : bool
    {
        return $value > 0 && $value < 1000;
    }
}