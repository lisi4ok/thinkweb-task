<?php

declare(strict_types=1);

namespace App\Shared\Application;

interface Mailer
{
    public function send(string $email, string $subject, string $body) : void;
}