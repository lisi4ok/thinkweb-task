<?php

declare(strict_types=1);

namespace App\Products\Domain\Exceptions;

use DomainException;

final class ProductConstraintViolation extends DomainException implements ProductException
{
    public static function principalNotAuthorized() : self
    {
        return new self('The principal is not authorized to complete the operation!');
    }

    public static function productIsNotScheduledForDeletion() : self
    {
        return new self('The product is not scheduled for deletion!');
    }

    public static function productIsNotMarkedForReview() : self
    {
        return new self('The product is not marked for review!');
    }
}