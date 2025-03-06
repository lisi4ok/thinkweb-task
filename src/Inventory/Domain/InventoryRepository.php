<?php

declare(strict_types=1);

namespace App\Inventory\Domain;

interface InventoryRepository
{
    public function byId(InventoryItemId $id) : InventoryItem;

    public function save(InventoryItem $item) : void;

    public function remove(InventoryItem $item) : void;

}