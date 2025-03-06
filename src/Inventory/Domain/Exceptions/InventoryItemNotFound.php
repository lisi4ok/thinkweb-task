<?php

declare(strict_types=1);

namespace App\Inventory\Domain\Exceptions;

use RuntimeException;

final class InventoryItemNotFound extends RuntimeException implements InventoryException
{

    public static function byId() : self
    {
        return new self('Inventory item was not found for the given Id!');
    }

}