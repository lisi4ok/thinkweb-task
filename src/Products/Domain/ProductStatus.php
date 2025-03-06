<?php

declare(strict_types=1);

namespace App\Products\Domain;

enum ProductStatus: int
{
    case FOR_DELETION = -2;
    case UNLISTED = -1;
    case FOR_REVIEW = 0;
    case LISTED = 1;

    public function isForReview() : bool
    {
        return $this === self::FOR_REVIEW;
    }

    public function isListed() : bool
    {
        return $this === self::LISTED;
    }

    public function isUnlisted() : bool
    {
        return $this === self::UNLISTED;
    }

    public function isScheduledForDeletion() : bool
    {
        return $this === self::FOR_DELETION;
    }
}
