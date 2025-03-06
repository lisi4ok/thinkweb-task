<?php

declare(strict_types=1);

namespace App\Shared\Http;

use App\Authentication\AuthenticatedUserProvider;
use App\Shared\Application\SellerAwareForm;
use Psr\Http\Message\ServerRequestInterface;

abstract class SellerAwareHttpFormFactory extends HttpFormFactory
{
    public function __construct(private readonly AuthenticatedUserProvider $authenticatedUserProvider)
    {
    }

    public function createFromRequest(ServerRequestInterface $request) : SellerAwareForm
    {
        $this->request = $request;
        $form = $this->createForm();
        $form->setSellerId($this->authenticatedUserProvider->authenticatedUserId());
        return $form;
    }

    abstract protected function createForm() : SellerAwareForm;

}