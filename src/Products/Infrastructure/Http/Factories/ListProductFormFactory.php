<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Http\Factories;

use App\Products\Application\Commands\ListProductForm;
use App\Shared\Http\SellerAwareHttpFormFactory;

final class ListProductFormFactory extends SellerAwareHttpFormFactory
{

    protected function createForm() : ListProductForm
    {
        $post = $this->request->getParsedBody();
        return new ListProductForm(
            trim($post['name'] ?? ''),
            (int) round(((float) ($post['price'] ?? 0)) * 100)
        );
    }
}
