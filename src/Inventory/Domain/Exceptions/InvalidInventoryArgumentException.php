<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Exceptions;

use InvalidArgumentException;

final class InvalidInventoryArgumentException extends InvalidArgumentException implements InventoryException
{
    public static function invalidItemName() : self
    {
        return new self('Invalid item name!');
    }
}