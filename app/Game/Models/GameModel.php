<?php

namespace App\Game\Models;

use Illuminate\Support\Str;

abstract class GameModel
{
    public function parseAttributes(array $attributes): void
    {
        foreach ($attributes as $key => $value) {
            $methodName = 'set' . Str::studly($key);

            if (method_exists($this, $methodName)) {
                $this->$methodName($value);
            }
        }
    }

    public function __set($name, $value)
    {
        $methodName = 'set' . Str::studly($name);

        if (property_exists($this, $name)) {
            $this->$methodName($value);
        }
    }

    public function __get($name)
    {
        $methodName = 'get' . Str::studly($name);

        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        return null;
    }

    public function __isset($name): bool
    {
        return ! is_null($this->$name);
    }
}
