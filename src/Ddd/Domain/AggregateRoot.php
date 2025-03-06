<?php

declare(strict_types=1);

namespace App\Ddd\Domain;

use App\Ddd\Domain\Events\DomainEvent;

abstract class AggregateRoot
{
    protected array $recordedEvents = [];

    /**
     * @return DomainEvent[]
     */
    public function recordedEvents(): array
    {
        return $this->recordedEvents;
    }

    public function clearRecordedEvents(): void
    {
        $this->recordedEvents = [];
    }


    protected function recordEvent(DomainEvent $event): void
    {
        $this->recordedEvents[] = $event;
    }
}