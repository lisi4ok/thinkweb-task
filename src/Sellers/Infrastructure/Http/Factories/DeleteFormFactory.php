<?php

declare(strict_types=1);

namespace App\Sellers\Infrastructure\Http\Factories;
use App\Sellers\Application\Commands\DeleteSellerForm;
use App\Shared\Http\ModeratorAwareHttpFormFactory;

final class DeleteFormFactory extends ModeratorAwareHttpFormFactory
{
    protected function createForm() : DeleteSellerForm
    {
        return new DeleteSellerForm($this->request->getParsedBody()['id'] ?? '');
    }
}