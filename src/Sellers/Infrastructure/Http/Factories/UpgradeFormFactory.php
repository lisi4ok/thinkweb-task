<?php

declare(strict_types=1);

namespace App\Sellers\Infrastructure\Http\Factories;
use App\Sellers\Application\Commands\UpgradeSellerForm;
use App\Shared\Http\ModeratorAwareHttpFormFactory;

final class UpgradeFormFactory extends ModeratorAwareHttpFormFactory
{
    protected function createForm() : UpgradeSellerForm
    {
        return new UpgradeSellerForm(
                $this->request->getParsedBody()['id'] ?? '',
                $this->request->getParsedBody()['level'] ?? ''
        );
    }
}