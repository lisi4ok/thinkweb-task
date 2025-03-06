<?php

declare(strict_types=1);

namespace App\Shared\Http;

use App\Ddd\Application\Form;
use Psr\Http\Message\ServerRequestInterface;

abstract class HttpFormFactory
{
    protected ServerRequestInterface $request;

    public function createFromRequest(ServerRequestInterface $request) : Form
    {
        $this->request = $request;
        return $this->createForm();
    }

    abstract protected function createForm() : Form;
}