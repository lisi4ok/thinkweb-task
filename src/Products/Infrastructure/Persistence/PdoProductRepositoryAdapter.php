<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Persistence;

use App\Products\Domain\Exceptions\ProductNotFound;
use App\Products\Domain\Product;
use App\Products\Domain\ProductId;
use App\Products\Domain\ProductName;
use App\Products\Domain\ProductPrice;
use App\Products\Domain\ProductRepositoryAdapter;
use App\Products\Domain\ProductStatus;
use App\Sellers\Domain\SellerId;
use App\Shared\Helpers\Reflector;
use App\Shared\Helpers\UuidService;
use PDO;

final readonly class PdoProductRepositoryAdapter implements ProductRepositoryAdapter
{
    public function __construct(private PDO $connection, private UuidService $uuidService)
    {
    }

    public function nextId() : ProductId
    {
        return ProductId::make('.....');
    }

    public function save(Product $product) : void
    {
        $reflected = Reflector::make($product);
        $binds = [
            'id'        => $this->uuidService->toBinary($reflected->get('id')),
            'seller_id' => $this->uuidService->toBinary($reflected->get('sellerId')),
            'name'      => $reflected->get('name')->value(),
            'price'     => $reflected->get('price')->value(),
            'status'    => $reflected->get('status')->value(),
        ];

        $query = "INSERT INTO products (id, seller_id, name, price, status) "
            . " VALUES(:id, :seller_id, :name, :price, :status)"
            . " ON DUPLICATE KEY UPDATE name = :name, price = :price, status = :status;";

        $stmt = $this->connection->prepare($query);
        $stmt->execute($binds);
    }

    public function delete(Product $product) : void
    {
        $query = "DELETE FROM products WHERE id = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [
                'id' => $this->uuidService->toBinary(
                    Reflector::make($product)->get('id')
                ),
            ]
        );
    }

    public function byId(ProductId $id) : Product
    {
        $query = "SELECT * FROM products WHERE id = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $id->value()]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($row)) {
            throw ProductNotFound::byId();
        }

        $productId = $this->uuidService->fromBinary($row['id'], ProductId::class);
        assert($productId instanceof ProductId);

        $sellerId = $this->uuidService->fromBinary($row['seller_id'], SellerId::class);
        assert($sellerId instanceof SellerId);

        return new Product(
            $productId,
            $sellerId,
            ProductName::make($row['name']),
            ProductPrice::from((int) $row['price']),
            ProductStatus::from((int) $row['status']),
        );
    }

    public function sellerHasListedProducts(SellerId $sellerId) : bool
    {
        $query = "SELECT COUNT(*) FROM products WHERE seller_id = :id AND status =:status;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $sellerId->value(), 'status' => ProductStatus::LISTED->value]);
        return $stmt->fetchColumn() ? true : false;
    }
}
