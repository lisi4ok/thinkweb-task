<?php

declare(strict_types=1);

namespace App\Products\Domain\Specifications;

use App\Products\Domain\Exceptions\ProductConstraintViolation;
use App\Products\Domain\Product;

final class DeletableProductSpecification implements ProductSpecification
{

    public function isSatisfiedBy(Product $product) : bool
    {
        return $product->status()->isScheduledForDeletion();
    }

    public function exception() : ProductConstraintViolation
    {
        return ProductConstraintViolation::productIsNotScheduledForDeletion();
    }
}