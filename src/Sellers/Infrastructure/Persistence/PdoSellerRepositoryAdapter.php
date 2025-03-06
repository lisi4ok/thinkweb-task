<?php

declare(strict_types=1);

namespace App\Sellers\Infrastructure\Persistence;

use App\Sellers\Domain\Exceptions\SellerNotFound;
use App\Sellers\Domain\Seller;
use App\Sellers\Domain\SellerId;
use App\Sellers\Domain\SellerLevel;
use App\Sellers\Domain\SellerRepositoryAdapter;
use App\Shared\Helpers\Reflector;
use App\Shared\Helpers\UuidService;
use DateTimeImmutable;
use PDO;

final class PdoSellerRepositoryAdapter implements SellerRepositoryAdapter
{
    private PDO $connection;
    private UuidService $uuidService;

    public function __construct(PDO $connection, UuidService $uuidService)
    {
        $this->connection = $connection;
        $this->uuidService = $uuidService;
    }

    public function nextId() : SellerId
    {
        return SellerId::make('.....');
    }

    public function save(Seller $seller) : void
    {
        $reflected = Reflector::make($seller);
        $binds = [
            'id'        => $this->uuidService->toBinary($reflected->get('id')),
            'level'     => SellerLevel::SILVER->value,
        ];

        $query = "INSERT INTO sellers (id, level) "
            . " VALUES(:id, :level);";

        $stmt = $this->connection->prepare($query);
        $stmt->execute($binds);
    }

    public function delete(Seller $seller) : void
    {
        $query = "DELETE FROM sellers WHERE id = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(
            [
                'id' => $this->uuidService->toBinary(
                    Reflector::make($seller)->get('id')
                ),
            ]
        );
    }

    public function byId(SellerId $id) : Seller
    {
        $query = "SELECT * FROM sellers WHERE id = :id;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute(['id' => $id->value()]);
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($row)) {
            throw SellerNotFound::byId();
        }

        $sellerId = $this->uuidService->fromBinary($row['id'], SellerId::class);
        assert($sellerId instanceof SellerId);

        return new Seller(
            $sellerId,
            SellerLevel::from($row['level']),
            new DateTimeImmutable()
        );
    }
}
