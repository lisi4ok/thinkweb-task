<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Moderators\Domain\ModeratorId;
use App\Products\Domain\ProductId;

final readonly class DeleteProduct
{
    public function __construct(
        public ProductId $productId,
        public ModeratorId $moderatorId
    ) {
    }

}
