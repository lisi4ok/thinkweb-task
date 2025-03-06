<?php

declare(strict_types=1);

namespace App\Products\Domain\Events;

use App\Moderators\Domain\ModeratorId;
use App\Products\Domain\ProductId;
use App\Products\Domain\ProductName;
use App\Products\Domain\ProductPrice;

final readonly class ProductApproved extends ProductEvent
{
    public function __construct(
        ProductId $productId,
        public ProductPrice $productPrice,
        public ProductName $productName,
        public ModeratorId $moderatorId
    ) {
        parent::__construct($productId);
    }

    public function productName() : ProductName
    {
        return $this->productName;
    }

    public function moderatorId() : ModeratorId
    {
        return $this->moderatorId;
    }

    public function productPrice() : ProductPrice
    {
        return $this->productPrice;
    }
}
