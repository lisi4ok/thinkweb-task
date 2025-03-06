<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Sellers\Domain\SellerRepository;

final readonly class UpgradeSellerHandler implements CommandHandler
{
    public function __construct(private SellerRepository $sellerRepository)
    {
    }

    public function handle(UpgradeSeller $command) : void
    {
        $seller = $this->sellerRepository->byId($command->sellerId);
        $seller->upgrade($command->moderatorId);
        $this->sellerRepository->save($seller);
    }
}
