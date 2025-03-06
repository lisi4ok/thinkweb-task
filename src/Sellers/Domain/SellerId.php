<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Sellers\Domain\Exceptions\InvalidSellerArgumentException;
use App\Shared\Domain\Vo\Uuid;
use InvalidArgumentException;

final class SellerId extends Uuid
{
    protected function invalidArgumentException() : InvalidArgumentException
    {
        return InvalidSellerArgumentException::invalidId();
    }
}