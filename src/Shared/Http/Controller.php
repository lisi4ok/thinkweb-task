<?php

declare(strict_types=1);

namespace App\Shared\Http;

use App\Ddd\Application\Bus;
use Exception;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

/**
 * Class Controller
 * @package App\Shared\Infrastructure\Http
 * This is not a production Controller code it is used for illustration only
 */
abstract class Controller
{
    protected Bus $bus;
    protected ServerRequestInterface $request;
    protected ResponseFactoryInterface $responseFactory;
    protected StreamFactoryInterface $streamFactory;

    public function setBus(Bus $bus) : void
    {
        $this->bus = $bus;
    }

    public function setServerRequest(ServerRequestInterface $request) : void
    {
        $this->request = $request;
    }

    public function setResponseFactories(
        ResponseFactoryInterface $responseFactory,
        StreamFactoryInterface $streamFactory
    ) : void {
        $this->responseFactory = $responseFactory;
        $this->streamFactory = $streamFactory;
    }

    public function handle(HttpFormFactory $formFactory) : ResponseInterface
    {
        $form = $formFactory->createFromRequest($this->request);
        if ($form->hasValidationErrors()) {
            return $this->respond(
                [
                    'error' => implode(' ', $form->validationErrors()),
                ],
                400
            );
        }

        try {
            $data = $this->bus->handle($form->toMessage()) ?? [];
            return $this->respond($data);
        }
        catch (Exception $exception) {
            return $this->respond(
                [
                    'error' => $exception->getMessage(),
                ],
                400
            );
        }
    }

    protected function respond(array $data, int $code = 200, array $headers = []) : ResponseInterface
    {
        $headers['content-type'] = 'application/json';
        $response = $this->responseFactory->createResponse($code)
            ->withBody($this->streamFactory->createStream(json_encode($data)))
        ;

        foreach ($headers as $name => $value) {
            $response = $response->withHeader($name, $value);
        }

        return $response;
    }
}