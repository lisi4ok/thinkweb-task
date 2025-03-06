<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Specifications;

use App\Sellers\Domain\Exceptions\SellerConstraintViolation;
use App\Sellers\Domain\Seller;
use App\Sellers\Domain\SellerLevel;
use DateTimeImmutable;

final class UpgradeSellerSpecification implements SellerSpecification
{
    public function isSatisfiedBy(Seller $seller) : bool
    {
        $now = new DateTimeImmutable;
        $registeredDaysAgo = $now->diff($seller->registeredOn)->days;

        if ($seller->level->isGold() && $registeredDaysAgo < 30) {
            return false;
        }

        return true;
    }

    public function exception() : SellerConstraintViolation
    {
        return SellerConstraintViolation::sellerCannotBeUpgraded();
    }
}