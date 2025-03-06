<?php

declare(strict_types=1);

namespace App\Ddd\Domain\Events;

use DateTimeImmutable;

trait ImplementsDomainEvent
{
    private int $eventVersion = 1;

    private DateTimeImmutable $occurredOn;

    public function eventVersion(): int
    {
        return $this->eventVersion;
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}