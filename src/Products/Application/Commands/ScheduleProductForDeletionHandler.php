<?php

declare(strict_types=1);

namespace App\Products\Application\Commands;

use App\Ddd\Application\CommandHandler;
use App\Products\Domain\ProductRepository;

final readonly class ScheduleProductForDeletionHandler implements CommandHandler
{
    public function __construct(private ProductRepository $productRepository)
    {
    }

    public function handle(ScheduleProductForDeletion $command) : void
    {
        $product = $this->productRepository->byId($command->productId);
        $product->scheduleForDeletion($command->sellerId);
        $this->productRepository->save($product);
    }
}
