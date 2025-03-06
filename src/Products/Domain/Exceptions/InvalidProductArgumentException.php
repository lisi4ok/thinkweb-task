<?php

declare(strict_types=1);

namespace App\Products\Domain\Exceptions;

use InvalidArgumentException;

final class InvalidProductArgumentException extends InvalidArgumentException implements ProductException
{
    public static function invalidId() : self
    {
        return new self('Invalid product Id!');
    }

    public static function invalidStatus() : self
    {
        return new self('Invalid product status!');
    }

    public static function invalidProductName() : self
    {
        return new self('Invalid product name!');
    }

    public static function invalidPriceValue() : self
    {
        return new self('Invalid price value!');
    }
}