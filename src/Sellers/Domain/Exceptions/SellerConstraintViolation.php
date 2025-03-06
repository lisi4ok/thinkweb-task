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

    public static function sellerIsNotForDeletion() : self
    {
        return new self('The seller is not for deletion!');
    }
}
