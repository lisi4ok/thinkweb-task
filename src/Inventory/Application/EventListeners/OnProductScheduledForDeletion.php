<?php

declare(strict_types=1);

namespace App\Inventory\Application\EventListeners;

use App\Ddd\Application\EventListener;
use App\Ddd\Domain\Events\DomainEvent;
use App\Inventory\Domain\Exceptions\InventoryItemNotFound;
use App\Inventory\Domain\InventoryItemId;
use App\Inventory\Domain\InventoryRepository;
use App\Products\Domain\Events\ProductScheduledForDeletion;

final readonly class OnProductScheduledForDeletion implements EventListener
{

    public function __construct(private InventoryRepository $inventoryRepository)
    {
    }

    public function handle(DomainEvent $event) : void
    {
        assert($event instanceof ProductScheduledForDeletion);

        $id = InventoryItemId::make($event->productId->value());

        try {
            $item = $this->inventoryRepository->byId($id);
            $item->delist();
            $this->inventoryRepository->remove($item);
        }
        catch (InventoryItemNotFound) {
        }
    }

    public function isSubscribedTo(DomainEvent $event) : bool
    {
        return $event instanceof ProductScheduledForDeletion;
    }
}
