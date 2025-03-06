<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Ddd\Application\Command;
use App\Moderators\Domain\ModeratorId;
use App\Sellers\Domain\SellerId;

final readonly class UpgradeSeller implements Command
{
    public function __construct(
        public SellerId $sellerId,
        public ModeratorId $moderatorId
    ) {
    }

}
