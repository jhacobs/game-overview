<?php

namespace App\Game\Models;

class Collection extends GameModel
{
    /** @var string */
    private $name;

    public static function parse(array $attributes): self
    {
        $collection = new self();

        $collection->parseAttributes($attributes);

        return $collection;
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
