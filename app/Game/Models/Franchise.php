<?php

namespace App\Game\Models;

class Franchise extends GameModel
{
    /** @var string */
    private $name;

    public static function parse(array $attributes): self
    {
        $franchise = new self();

        $franchise->parseAttributes($attributes);

        return $franchise;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
