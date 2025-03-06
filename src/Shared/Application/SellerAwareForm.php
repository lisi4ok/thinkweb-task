<?php

declare(strict_types=1);

namespace App\Shared\Application;

use App\Ddd\Application\Form;
use App\Sellers\Domain\SellerId;

abstract class SellerAwareForm extends Form
{
    private string $sellerId;

    public function setSellerId(string $sellerId) : void
    {
        $this->sellerId = $sellerId;
    }

    protected function sellerId() : SellerId
    {
        return SellerId::make($this->sellerId);
    }
}