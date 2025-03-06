<?php

declare(strict_types=1);

namespace App\Sellers\Infrastructure\Http;

use App\Sellers\Infrastructure\Http\Factories\DeleteFormFactory;
use App\Sellers\Infrastructure\Http\Factories\UpgradeFormFactory;
use App\Shared\Http\Controller;
use Psr\Http\Message\ResponseInterface;

final class SellerController extends Controller
{
    public function upgrade(UpgradeFormFactory $formFactory) : ResponseInterface
    {
        return $this->handle($formFactory);
    }

    public function delete(DeleteFormFactory $formFactory) : ResponseInterface
    {
        return $this->handle($formFactory);
    }
}