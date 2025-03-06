<?php

declare(strict_types=1);

namespace App\Sellers\Domain\Exceptions;

use DomainException;

final class CannotDeleteSellerException extends DomainException implements SellerException
{
}