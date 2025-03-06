<?php

declare(strict_types=1);

namespace App\Shared\Helpers;

use App\Shared\Domain\Vo\Uuid;
use Ramsey\Uuid\UuidFactory;

final readonly class UuidService
{
    public function __construct(private UuidFactory $factory)
    {
    }

    public function generate(string $class = Uuid::class) : Uuid
    {
        return $class::make(
            $this->clean(
                $this->factory->uuid4()->toString()
            )
        );
    }

    public function toBinary(Uuid $uuid) : string
    {
        return $this->factory->fromString($uuid->value())->getBytes();
    }

    public function fromBinary(string $binary, string $class = null) : Uuid
    {
        $class ??= Uuid::class;

        return $class::make(
            $this->clean(
                $this->factory->fromBytes($binary)->toString()
            )
        );
    }

    private function clean(string $value) : string
    {
        return str_replace('-', '', $value);
    }
}
