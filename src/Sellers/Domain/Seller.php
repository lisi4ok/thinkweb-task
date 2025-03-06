<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Ddd\Domain\AggregateRoot;
use App\Moderators\Domain\ModeratorId;
use App\Sellers\Domain\Events\SellerLevelChanged;
use DateTimeImmutable;

final class Seller extends AggregateRoot
{
    public function __construct(
        public readonly SellerId $id,
        private SellerLevel $level,
        public readonly DateTimeImmutable $registeredOn
    ) {
    }

    public function upgrade(ModeratorId $moderatorId) : void
    {
        $this->level = $this->level->upgrade();
        $this->recordEvent(new SellerLevelChanged($this->id, $this->level, $moderatorId));
    }

    public function downgrade(ModeratorId $moderatorId) : void
    {
        $this->level = $this->level->downgrade();
        $this->recordEvent(new SellerLevelChanged($this->id, $this->level, $moderatorId));
    }
}
