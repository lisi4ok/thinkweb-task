<?php

declare(strict_types=1);

namespace App\Sellers\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Products\Domain\ProductRepository;
use App\Sellers\Domain\Exceptions\SellerConstraintViolation;
//use App\Sellers\Domain\Exceptions\CannotDeleteSellerException;
use App\Sellers\Domain\SellerRepository;

final readonly class DeleteSellerHandler implements CommandHandler
{
    public function __construct(
        private SellerRepository $sellerRepository,
        private ProductRepository $productRepository
    )
    {
    }

    public function handle(DeleteSeller $command) : void
    {
        if ($this->productRepository->sellerHasListedProducts($command->sellerId)) {
            // we can use both cases
            throw SellerConstraintViolation::sellerIsNotForDeletion();
            //throw new CannotDeleteSellerException('Seller has products in the inventory and cannot be deleted.');
        }

        $seller = $this->sellerRepository->byId($command->sellerId);
        $seller->delete($command->moderatorId);
        $this->sellerRepository->delete($seller);
    }
}
