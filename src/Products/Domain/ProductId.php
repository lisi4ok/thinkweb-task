<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Products\Domain\Exceptions\InvalidProductArgumentException;
use App\Shared\Domain\Vo\Uuid;
use InvalidArgumentException;

final class ProductId extends Uuid
{
    protected function invalidArgumentException() : InvalidArgumentException
    {
        return InvalidProductArgumentException::invalidId();
    }
}