<?php

declare(strict_types=1);

namespace App\Inventory\Application\EventListeners;

use App\Ddd\Application\EventListener;
use App\Ddd\Domain\Events\DomainEvent;
use App\Inventory\Domain\Exceptions\InventoryItemNotFound;
use App\Inventory\Domain\InventoryItemId;
use App\Inventory\Domain\InventoryRepository;
use App\Products\Domain\Events\ProductRepriced;

final readonly class OnProductRepriced implements EventListener
{

    public function __construct(private InventoryRepository $inventoryRepository)
    {
    }

    public function handle(DomainEvent $event) : void
    {
        assert($event instanceof ProductRepriced);

        $id = InventoryItemId::make($event->productId->value());

        try {
            $item = $this->inventoryRepository->byId($id);
            $item->reprice($event->productPrice);
            $this->inventoryRepository->save($item);
        }
        catch (InventoryItemNotFound) {
        }
    }

    public function isSubscribedTo(DomainEvent $event) : bool
    {
        return $event instanceof ProductRepriced;
    }
}
