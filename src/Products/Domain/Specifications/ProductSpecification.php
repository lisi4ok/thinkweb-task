<?php

declare(strict_types=1);

namespace App\Products\Domain\Specifications;

use App\Products\Domain\Product;

interface ProductSpecification
{
    public function isSatisfiedBy(Product $product) : bool;
}