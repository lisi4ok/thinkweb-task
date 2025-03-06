<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Products\Domain\ProductRepository;

final readonly class ApproveProductHandler implements CommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(ApproveProduct $command) : void
    {
        $product = $this->productRepository->byId($command->productId);
        $product->approve($command->moderatorId);
        $this->productRepository->save($product);
    }
}
