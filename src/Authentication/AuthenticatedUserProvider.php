<?php

declare(strict_types=1);

namespace App\Authentication;

interface AuthenticatedUserProvider
{
    public function authenticatedUserId() : string;
}