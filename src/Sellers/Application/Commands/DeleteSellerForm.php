<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Sellers\Domain\SellerId;
use App\Shared\Application\ModeratorAwareForm;

final class DeleteSellerForm extends ModeratorAwareForm
{
    private string $sellerId;

    public function __construct(string $sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function toMessage() : DeleteSeller
    {
        return new DeleteSeller(
            SellerId::make($this->sellerId),
            $this->moderatorId()
        );
    }

    protected function validate() : void
    {
        if (!SellerId::isValid($this->sellerId)) {
            $this->errors[] = 'Invalid seller Id!';
        }
    }
}