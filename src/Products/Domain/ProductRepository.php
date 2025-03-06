<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Ddd\EventDispatcher;
use App\Products\Domain\Exceptions\ProductConstraintViolation;
use App\Products\Domain\Exceptions\ProductNotFound;
use App\Products\Domain\Specifications\DeletableProductSpecification;
use App\Sellers\Domain\SellerId;

final readonly class ProductRepository
{
    public function __construct(private ProductRepositoryAdapter $adapter, private EventDispatcher $eventDispatcher)
    {
    }

    public function nextId() : ProductId
    {
        return $this->adapter->nextId();
    }

    /**
     * @param ProductId $id
     * @return Product
     * @throws ProductNotFound
     */
    public function byId(ProductId $id) : Product
    {
        return $this->adapter->byId($id);
    }

    public function save(Product $product) : void
    {
        $this->adapter->save($product);
        $this->dispatchEvents($product);
    }

    public function delete(Product $product) : void
    {
        $specification = new DeletableProductSpecification();
        if (!$specification->isSatisfiedBy($product)) {
            throw ProductConstraintViolation::productIsNotScheduledForDeletion();
        }

        $this->adapter->delete($product);
        $this->dispatchEvents($product);
    }

    public function sellerHasListedProducts(SellerId $sellerId) : bool
    {
        return $this->adapter->sellerHasListedProducts($sellerId);
    }

    private function dispatchEvents(Product $product) : void
    {
        foreach ($product->recordedEvents() as $event) {
            $this->eventDispatcher->dispatch($event);
        }
        $product->clearRecordedEvents();
    }
}