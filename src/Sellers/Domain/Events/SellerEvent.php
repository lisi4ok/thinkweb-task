<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Events;

use App\Ddd\Domain\Events\DomainEvent;
use App\Ddd\Domain\Events\ImplementsDomainEvent;
use App\Sellers\Domain\SellerId;
use DateTimeImmutable;

abstract readonly class SellerEvent implements DomainEvent
{
    use ImplementsDomainEvent;

    public function __construct(public SellerId $sellerId)
    {
        $this->occurredOn = new DateTimeImmutable();
    }
}
