<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Products\Domain\ProductId;
use App\Shared\Application\SellerAwareForm;

final class ScheduleProductForDeletionForm extends SellerAwareForm
{
    public function __construct(private readonly string $productId)
    {
    }

    public function toMessage() : ScheduleProductForDeletion
    {
        return new ScheduleProductForDeletion(
            ProductId::make($this->productId),
            $this->sellerId()
        );
    }

    protected function validate() : void
    {
        if (!ProductId::isValid($this->productId)) {
            $this->errors[] = 'Invalid product Id!';
        }
    }
}
