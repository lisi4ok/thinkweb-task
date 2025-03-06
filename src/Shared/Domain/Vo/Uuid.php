<?php

declare(strict_types=1);

namespace App\Shared\Domain\Vo;

use InvalidArgumentException;

/**
 * This class needs to be extendable to create domain specific IDs
 */
class Uuid
{
    private const VALID_PATTERN = '/^[0-9a-f]{12}4[0-9a-f]{3}[89ab][0-9a-f]{15}$/iD';
    private readonly string $value;

    private function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw $this->invalidArgumentException();
        }

        $this->value = $value;
    }

    public static function isValid(string $value) : bool
    {
        return (bool) preg_match(self::VALID_PATTERN, $value);
    }

    /**
     * @param string $value
     * @return static
     */
    public static function make(string $value) : self
    {
        return new static(str_replace('-', '', $value));
    }

    public function value() : string
    {
        return $this->value;
    }

    public function is(self $other) : bool
    {
        return $this->value === $other->value;
    }

    public function isNot(self $other) : bool
    {
        return !$this->is($other);
    }

    protected function invalidArgumentException() : InvalidArgumentException
    {
        return new InvalidArgumentException('Invalid UUID!');
    }

}
