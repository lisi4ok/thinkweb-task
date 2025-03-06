<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Http;

use App\Products\Infrastructure\Http\Factories\ListProductFormFactory;
use App\Products\Infrastructure\Http\Factories\ScheduleForDeletionFormFactory;
use App\Shared\Http\Controller;
use Psr\Http\Message\ResponseInterface;

final class ProductController extends Controller
{
    public function create(ListProductFormFactory $formFactory) : ResponseInterface
    {
        return $this->handle($formFactory);
    }

    public function delete(ScheduleForDeletionFormFactory $formFactory) : ResponseInterface
    {
        return $this->handle($formFactory);
    }
}