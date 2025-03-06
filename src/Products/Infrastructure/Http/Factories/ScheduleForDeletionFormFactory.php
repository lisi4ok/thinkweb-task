<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Http\Factories;

use App\Products\Application\Commands\ScheduleProductForDeletionForm;
use App\Shared\Http\SellerAwareHttpFormFactory;

final class ScheduleForDeletionFormFactory extends SellerAwareHttpFormFactory
{

    protected function createForm() : ScheduleProductForDeletionForm
    {
        return new ScheduleProductForDeletionForm(
            $this->request->getParsedBody()['id'] ?? ''
        );
    }
}
