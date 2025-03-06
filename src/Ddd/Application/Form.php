<?php

declare(strict_types=1);

namespace App\Ddd\Application;

abstract class Form
{
    protected array $errors = [];

    abstract public function toMessage() : Message;

    public function hasValidationErrors() : bool
    {
        return ($this->validationErrors() !== []);
    }

    public function validationErrors() : array
    {
        if ($this->errors !== []) {
            return $this->errors;
        }

        $this->validate();
        return $this->errors;
    }

    abstract protected function validate() : void;
}