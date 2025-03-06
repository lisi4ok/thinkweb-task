<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Sellers\Domain\SellerRepository;
use App\Sellers\Domain\Specifications\UpgradeSellerSpecification;

final readonly class UpgradeSellerHandler implements CommandHandler
{
    public function __construct(private SellerRepository $sellerRepository,
                                private UpgradeSellerSpecification $specification)
    {
    }

    public function handle(UpgradeSeller $command) : void
    {
        $seller = $this->sellerRepository->byId($command->sellerId);
        $seller->upgrade($command->moderatorId, $this->specification);
        $this->sellerRepository->save($seller);
    }
}
