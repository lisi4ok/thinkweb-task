<?php

declare(strict_types=1);

namespace App\Products\Domain\Events;

use App\Moderators\Domain\ModeratorId;
use App\Products\Domain\ProductId;

final readonly class ProductDeleted extends ProductEvent
{
    public function __construct(ProductId $productId, public ModeratorId $moderatorId)
    {
        parent::__construct($productId);
    }
}
