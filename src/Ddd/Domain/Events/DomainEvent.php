<?php

declare(strict_types=1);

namespace App\Ddd\Domain\Events;

use DateTimeImmutable;

interface DomainEvent
{
    public function eventVersion() : int;

    public function occurredOn() : DateTimeImmutable;
}