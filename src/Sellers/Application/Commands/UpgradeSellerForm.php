<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Sellers\Domain\SellerId;
use App\Shared\Application\ModeratorAwareForm;

final class UpgradeSellerForm extends ModeratorAwareForm
{
    private string $sellerId;
    private int $level;

    public function __construct(string $sellerId, string|int $level)
    {
        $this->sellerId = $sellerId;
        $this->level = (int) $level;
    }

    public function toMessage() : UpgradeSeller
    {
        return new UpgradeSeller(
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