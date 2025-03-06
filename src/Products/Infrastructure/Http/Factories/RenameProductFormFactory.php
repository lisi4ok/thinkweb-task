<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Http\Factories;

use App\Products\Application\Commands\RenameProductForm;
use App\Shared\Http\SellerAwareHttpFormFactory;

final class RenameProductFormFactory extends SellerAwareHttpFormFactory
{

    protected function createForm() : RenameProductForm
    {
        $post = $this->request->getParsedBody() ?? [];
        return new RenameProductForm(
            $post['id'] ?? '',
            $post['name'] ?? '',
        );
    }
}