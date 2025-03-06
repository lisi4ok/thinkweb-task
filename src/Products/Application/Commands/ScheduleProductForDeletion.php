<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\Command;
use App\Products\Domain\ProductId;
use App\Sellers\Domain\SellerId;

final readonly class ScheduleProductForDeletion implements Command
{
    public function __construct(
        public ProductId $productId,
        public SellerId $sellerId
    ) {
    }
}
