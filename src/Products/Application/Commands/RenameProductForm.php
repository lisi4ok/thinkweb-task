<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Products\Domain\ProductId;
use App\Products\Domain\ProductName;
use App\Shared\Application\SellerAwareForm;

final class RenameProductForm extends SellerAwareForm
{
    public function __construct(
        private readonly string $productId,
        private readonly string $name
    ) {
    }

    public function toMessage() : RenameProduct
    {
        return new RenameProduct(
            ProductId::make($this->productId),
            ProductName::make($this->name),
            $this->sellerId()
        );
    }

    protected function validate() : void
    {
        if (!ProductId::isValid($this->productId)) {
            $this->errors[] = 'Invalid product Id!';
        }

        if (!ProductName::isValid($this->name)) {
            $this->errors[] = 'Invalid product name!';
        }
    }
}
