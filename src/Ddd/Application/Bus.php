<?php

declare(strict_types=1);

namespace App\Ddd\Application;

interface Bus
{
    /**
     * @param Message $message
     * @return mixed
     */
    public function handle(Message $message) : mixed;
}
