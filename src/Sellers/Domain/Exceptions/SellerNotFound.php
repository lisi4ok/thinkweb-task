<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Exceptions;

use RuntimeException;

final class SellerNotFound extends RuntimeException implements SellerException
{
    public static function byId() : self
    {
        return new self('Seller was not found for the given Id!');
    }
}