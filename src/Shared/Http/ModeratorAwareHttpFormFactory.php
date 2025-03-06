<?php

declare(strict_types=1);

namespace App\Shared\Http;

use App\Authentication\AuthenticatedUserProvider;
use App\Shared\Application\ModeratorAwareForm;
use Psr\Http\Message\ServerRequestInterface;

abstract class ModeratorAwareHttpFormFactory extends HttpFormFactory
{
    public function __construct(private readonly AuthenticatedUserProvider $authenticatedUserProvider)
    {
    }

    public function createFromRequest(ServerRequestInterface $request) : ModeratorAwareForm
    {
        $this->request = $request;
        $form = $this->createForm();
        $form->setModeratorId($this->authenticatedUserProvider->authenticatedUserId());
        return $form;
    }

    abstract protected function createForm() : ModeratorAwareForm;

}