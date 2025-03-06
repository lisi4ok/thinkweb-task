<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Exceptions;

use InvalidArgumentException;

final class InvalidSellerArgumentException extends InvalidArgumentException implements SellerException
{
    public static function invalidDisplayName() : self
    {
        return new self('Invalid display name!');
    }
    public static function invalidId() : self
    {
        return new self('Invalid seller Id!');
    }
}