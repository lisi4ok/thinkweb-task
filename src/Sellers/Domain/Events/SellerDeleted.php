<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Events;

use App\Moderators\Domain\ModeratorId;
use App\Sellers\Domain\SellerId;

final readonly class SellerDeleted extends SellerEvent
{
    public function __construct(
        SellerId $sellerId,
        public ModeratorId $moderatorId
    ) {
        parent::__construct($sellerId);
    }
}
