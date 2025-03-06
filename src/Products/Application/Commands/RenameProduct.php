<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\Command;
use App\Products\Domain\ProductId;
use App\Products\Domain\ProductName;
use App\Sellers\Domain\SellerId;

final readonly class RenameProduct implements Command
{
    public function __construct(
        public ProductId $productId,
        public ProductName $name,
        public SellerId $sellerId
    ) {
    }

}
