<?php

declare(strict_types=1);

namespace App\Inventory\Application\EventListeners;

use App\Ddd\Application\EventListener;
use App\Ddd\Domain\Events\DomainEvent;
use App\Inventory\Domain\Exceptions\InventoryItemNotFound;
use App\Inventory\Domain\InventoryItem;
use App\Inventory\Domain\InventoryItemId;
use App\Inventory\Domain\InventoryRepository;
use App\Inventory\Domain\ItemName;
use App\Products\Domain\Events\ProductApproved;

final readonly class OnProductApproved implements EventListener
{

    public function __construct(private InventoryRepository $inventoryRepository)
    {
    }

    public function handle(DomainEvent $event) : void
    {
        assert($event instanceof ProductApproved);

        $id = InventoryItemId::make($event->productId->value());
        $name = ItemName::make($event->productName->value());

        try {
            $item = $this->inventoryRepository->byId($id);
            $item->rename($name);
            $item->reprice($event->productPrice);
        }
        catch (InventoryItemNotFound) {
            $item = new InventoryItem($id, $event->productPrice, $name);
        }

        $this->inventoryRepository->save($item);
    }

    public function isSubscribedTo(DomainEvent $event) : bool
    {
        return $event instanceof ProductApproved;
    }
}
