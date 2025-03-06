<?php

declare(strict_types=1);

namespace App\Ddd\Application;

use App\Ddd\Domain\Events\DomainEvent;

interface EventListener
{
    public function handle(DomainEvent $event): void;

    public function isSubscribedTo(DomainEvent $event): bool;
}