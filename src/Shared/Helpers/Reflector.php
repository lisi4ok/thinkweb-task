<?php

declare(strict_types=1);

namespace App\Shared\Helpers;

use ReflectionObject;

final readonly class Reflector
{
    private function __construct(private object $object, private ReflectionObject $reflectionObject)
    {
    }

    public static function make(object $object) : self
    {
        return new self($object, new ReflectionObject($object));
    }

    public function get(string $property)
    {
        $property = $this->reflectionObject->getProperty($property);
        /** @noinspection PhpExpressionResultUnusedInspection */
        $property->setAccessible(true);
        return $property->getValue($this->object);
    }
}
