<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Events;

use App\Moderators\Domain\ModeratorId;
use App\Sellers\Domain\SellerId;
use App\Sellers\Domain\SellerLevel;

final readonly class SellerLevelChanged extends SellerEvent
{

    public function __construct(
        SellerId $sellerId,
        public SellerLevel $newLevel,
        public ModeratorId $moderatorId
    ) {
        parent::__construct($sellerId);
    }
}
