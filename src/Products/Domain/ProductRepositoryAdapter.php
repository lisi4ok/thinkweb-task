<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Products\Domain\Exceptions\ProductNotFound;

interface ProductRepositoryAdapter
{

    public function nextId() : ProductId;

    /**
     * @param ProductId $id
     * @return Product
     * @throws ProductNotFound
     */
    public function byId(ProductId $id) : Product;

    public function save(Product $product) : void;

    public function delete(Product $product) : void;
}