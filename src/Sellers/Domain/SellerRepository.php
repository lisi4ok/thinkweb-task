<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Ddd\EventDispatcher;
use App\Sellers\Domain\Exceptions\SellerNotFound;

final readonly class SellerRepository
{
    public function __construct(
        private SellerRepositoryAdapter $adapter,
        private EventDispatcher $eventDispatcher
    ) {
    }

    public function nextId() : SellerId
    {
        return $this->adapter->nextId();
    }

    /**
     * @param SellerId $id
     * @return Seller
     * @throws SellerNotFound
     */
    public function byId(SellerId $id) : Seller
    {
        return $this->adapter->byId($id);
    }

    public function save(Seller $seller) : void
    {
        $this->adapter->save($seller);
        $this->dispatchEvents($seller);
    }

    public function delete(Seller $seller) : void
    {
        $this->adapter->delete($seller);
        $this->dispatchEvents($seller);
    }

    private function dispatchEvents(Seller $seller) : void
    {
        foreach ($seller->recordedEvents() as $event) {
            $this->eventDispatcher->dispatch($event);
        }
        $seller->clearRecordedEvents();
    }
}
