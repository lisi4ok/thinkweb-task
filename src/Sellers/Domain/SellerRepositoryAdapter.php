<?php

declare(strict_types=1);

namespace App\Sellers\Domain;

use App\Sellers\Domain\Exceptions\SellerNotFound;

interface SellerRepositoryAdapter
{

    public function nextId() : SellerId;

    /**
     * @param SellerId $id
     * @return Seller
     * @throws SellerNotFound
     */
    public function byId(SellerId $id) : Seller;

    public function save(Seller $product) : void;

    public function delete(Seller $product) : void;
}