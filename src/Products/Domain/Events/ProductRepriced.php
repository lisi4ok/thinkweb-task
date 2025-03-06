<?php

declare(strict_types=1);

namespace App\Products\Domain\Events;

use App\Products\Domain\ProductId;
use App\Products\Domain\ProductPrice;

final readonly class ProductRepriced extends ProductEvent
{
    public function __construct(ProductId $productId, public ProductPrice $productPrice)
    {
        parent::__construct($productId);
    }
}
