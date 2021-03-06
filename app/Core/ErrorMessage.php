<?php namespace App\Core;

class ErrorMessage
{
    public array $errors = [];

    public function set($name, $error)
    {
        $this->errors[$name][] = $error;
    }

    public function has($name): bool
    {
        return isset($this->errors[$name]);
    }

    public function count(): bool
    {
        return count($this->errors);
    }

    public function get($name)
    {
        return $this->has($name) ?
        $this->errors[$name] : null;

    }

}
