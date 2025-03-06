<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Products\Domain\ProductName;
use App\Products\Domain\ProductPrice;
use App\Shared\Application\SellerAwareForm;

final class ListProductForm extends SellerAwareForm
{
    public function __construct(
        private readonly string $name,
        private readonly int $price
    ) {
    }

    public function toMessage() : ListProduct
    {
        return new ListProduct(
            ProductName::make($this->name),
            ProductPrice::from($this->price),
            $this->sellerId()
        );
    }

    protected function validate() : void
    {
        if (!ProductName::isValid($this->name)) {
            $this->errors[] = 'Invalid name!';
        }

        if (!ProductPrice::isValid($this->price)) {
            $this->errors[] = 'Invalid price!';
        }
    }
}
