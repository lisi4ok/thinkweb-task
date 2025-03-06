<?php

declare(strict_types=1);

namespace App\Products\Domain\Exceptions;

use RuntimeException;

final class ProductNotFound extends RuntimeException implements ProductException
{
    public static function byId() : self
    {
        return new self('Product was not found for the given Id!');
    }
}