<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Ddd\Domain\AggregateRoot;
use App\Moderators\Domain\ModeratorId;
use App\Products\Domain\Events\ProductApproved;
use App\Products\Domain\Events\ProductDeleted;
use App\Products\Domain\Events\ProductRepriced;
use App\Products\Domain\Events\ProductScheduledForDeletion;
use App\Products\Domain\Exceptions\ProductConstraintViolation;
use App\Products\Domain\Specifications\DeletableProductSpecification;
use App\Sellers\Domain\SellerId;

final class Product extends AggregateRoot
{
    public function __construct(
        private readonly ProductId $id,
        private readonly SellerId $sellerId,
        private ProductName $name,
        private ProductPrice $price,
        private ProductStatus $status
    ) {
    }

    public static function create(
        ProductId $id,
        SellerId $sellerId,
        ProductName $name,
        ProductPrice $price
    ) : self {
        return new self(
            $id,
            $sellerId,
            $name,
            $price,
            ProductStatus::FOR_REVIEW
        );
    }

    public function status() : ProductStatus
    {
        return $this->status;
    }

    public function reprice(ProductPrice $price, SellerId $principal) : void
    {
        $this->principalGuard($principal);
        if ($this->price->isNot($price)) {
            $this->price = $price;
            $this->recordEvent(new ProductRepriced($this->id, $this->price));
        }
    }

    public function rename(ProductName $name, SellerId $principal) : void
    {
        $this->principalGuard($principal);
        if ($this->name->isNot($name)) {
            $this->name = $name;
            $this->markForReview();
        }
    }

    public function scheduleForDeletion(SellerId $principal) : void
    {
        $this->principalGuard($principal);
        $this->status = ProductStatus::FOR_DELETION;
        $this->recordEvent(new ProductScheduledForDeletion($this->id));
    }

    public function approve(ModeratorId $moderatorId) : void
    {
        if ($this->status !== ProductStatus::FOR_REVIEW) {
            throw ProductConstraintViolation::productIsNotMarkedForReview();
        }
        $this->status = ProductStatus::LISTED;
        $this->recordEvent(new ProductApproved($this->id, $this->price, $this->name, $moderatorId));
    }

    public function delete(ModeratorId $moderatorId, DeletableProductSpecification $specification) : void
    {
        if (!$specification->isSatisfiedBy($this)) {
            throw $specification->exception();
        }

        $this->recordEvent(new ProductDeleted($this->id, $moderatorId));
    }

    private function markForReview() : void
    {
        $this->status = ProductStatus::FOR_REVIEW;
    }

    private function principalGuard(SellerId $principal) : void
    {
        if ($this->sellerId->isNot($principal)) {
            throw ProductConstraintViolation::principalNotAuthorized();
        }
    }
}
