<?php

declare(strict_types=1);

namespace App\Inventory\Domain;

use App\Shared\Domain\Vo\Price;

final class InventoryItem
{
    public function __construct(
        private readonly InventoryItemId $id,
        private Price $price,
        private ItemName $name
    ) {
    }

    public function id() : InventoryItemId
    {
        return $this->id;
    }

    public function price() : Price
    {
        return $this->price;
    }

    public function name() : ItemName
    {
        return $this->name;
    }

    public function rename(ItemName $name) : void
    {
        $this->name = $name;
    }

    public function reprice(Price $price) : void
    {
        $this->price = $price;
    }

    public function delist() : void
    {
        // NOTE Can dispatch some events.....
    }
}
