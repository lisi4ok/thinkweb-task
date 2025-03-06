<?php

declare(strict_types=1);

namespace App\Shared\Application;

use App\Ddd\Application\EventListener;
use App\Ddd\Domain\Events\DomainEvent;
use App\Ddd\EventDispatcher;

final readonly class OrderedEventDispatcher implements EventDispatcher
{
    /**
     * @param EventListener[] $listeners
     */
    public function __construct(private array $listeners)
    {
    }

    public function dispatch(DomainEvent $event) : void
    {
        foreach ($this->listeners as $listener) {
            if ($listener->isSubscribedTo($event)) {
                $listener->handle($event);
            }
        }
    }
}