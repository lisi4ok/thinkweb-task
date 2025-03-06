<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Sellers\Domain\Exceptions\SellerConstraintViolation;

enum SellerLevel: int
{
    case BRONZE = 1;
    case SILVER = 2;
    case GOLD = 3;

    public function upgrade(): self
    {
        if ($this === self::GOLD) {
            throw SellerConstraintViolation::sellerAtMaxLevel();
        }
        return self::from($this->value + 1);
    }

    public function downgrade(): self
    {
        if ($this === self::BRONZE) {
            throw SellerConstraintViolation::sellerAtMinLevel();
        }
        return self::from($this->value - 1);
    }

    public function maxListedProducts(): int
    {
        return $this->value * 3;
    }

    public function isGold(): bool
    {
        return $this === self::GOLD;
    }
}
