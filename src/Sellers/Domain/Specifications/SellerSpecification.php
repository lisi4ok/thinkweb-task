<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Specifications;

use App\Sellers\Domain\Seller;

interface SellerSpecification
{
    public function isSatisfiedBy(Seller $seller) : bool;
}