<?php

declare(strict_types=1);

namespace App\Products\Domain\Events;

use App\Ddd\Domain\Events\DomainEvent;
use App\Ddd\Domain\Events\ImplementsDomainEvent;
use App\Products\Domain\ProductId;
use DateTimeImmutable;

abstract readonly class ProductEvent implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(public ProductId $productId)
    {
        $this->occurredOn = new DateTimeImmutable();
    }
}
