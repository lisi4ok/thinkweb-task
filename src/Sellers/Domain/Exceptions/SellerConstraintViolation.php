<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Exceptions;

use DomainException;

final class SellerConstraintViolation extends DomainException implements SellerException
{
    public static function sellerAtMaxLevel() : self
    {
        return new self('Seller is already at max level!');
    }

    public static function sellerAtMinLevel() : self
    {
        return new self('Seller is already at min level!');
    }

    public static function sellerCannotBeDeleted() : self
    {
        return new self('The seller can not deleted!');
    }

    public static function sellerCannotBeUpgraded() : self
    {
        return new self('The seller can not upgraded!');
    }
}
