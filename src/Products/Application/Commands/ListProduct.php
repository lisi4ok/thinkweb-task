<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\Command;
use App\Products\Domain\ProductName;
use App\Products\Domain\ProductPrice;
use App\Sellers\Domain\SellerId;

final readonly class ListProduct implements Command
{
    public function __construct(
        public ProductName $name,
        public ProductPrice $price,
        public SellerId $sellerId
    ) {
    }
}
