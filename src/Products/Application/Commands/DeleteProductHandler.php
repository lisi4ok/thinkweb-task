<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Products\Domain\ProductRepository;
use App\Products\Domain\Specifications\DeletableProductSpecification;

final readonly class DeleteProductHandler implements CommandHandler
{
    public function __construct(
        private ProductRepository $productRepository,
        private DeletableProductSpecification $deletableProductSpecification
    ) {
    }

    public function handle(DeleteProduct $command) : void
    {
        $product = $this->productRepository->byId($command->productId);
        $product->delete($command->moderatorId, $this->deletableProductSpecification);
        $this->productRepository->delete($product);
    }
}
