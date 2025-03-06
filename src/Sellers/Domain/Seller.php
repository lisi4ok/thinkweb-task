<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Ddd\Domain\AggregateRoot;
use App\Moderators\Domain\ModeratorId;
use App\Sellers\Domain\Events\SellerDeleted;
use App\Sellers\Domain\Events\SellerLevelChanged;
use App\Sellers\Domain\Specifications\UpgradeSellerSpecification;
use DateTimeImmutable;

final class Seller extends AggregateRoot
{
    public function __construct(
        public readonly SellerId $id,
        public SellerLevel $level,
        public readonly DateTimeImmutable $registeredOn
    ) {
    }

    public function upgrade(ModeratorId $moderatorId, UpgradeSellerSpecification $specification) : void
    {
        if (!$specification->isSatisfiedBy($this)) {
            throw $specification->exception();
        }

        $this->level = $this->level->upgrade();
        $this->recordEvent(new SellerLevelChanged($this->id, $this->level, $moderatorId));
    }

    public function downgrade(ModeratorId $moderatorId) : void
    {
        $this->level = $this->level->downgrade();
        $this->recordEvent(new SellerLevelChanged($this->id, $this->level, $moderatorId));
    }

    public function delete(ModeratorId $moderatorId) : void
    {
        $this->recordEvent(new SellerDeleted($this->id, $moderatorId));
    }
}
