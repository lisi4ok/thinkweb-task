<?php

declare(strict_types=1);

namespace App\Ddd;

use App\Ddd\Domain\Events\DomainEvent;

interface EventDispatcher
{
    public function dispatch(DomainEvent $event) : void;
}