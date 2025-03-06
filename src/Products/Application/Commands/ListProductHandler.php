<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Products\Domain\Product;
use App\Products\Domain\ProductRepository;

final readonly class ListProductHandler implements CommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(ListProduct $command) : void
    {
        $product = Product::create(
            $this->productRepository->nextId(),
            $command->sellerId,
            $command->name,
            $command->price
        );

        $this->productRepository->save($product);
    }
}
