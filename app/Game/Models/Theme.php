<?php

namespace App\Game\Models;

class Theme extends GameModel
{
    /** @var string */
    private $name;

    public static function parse(array $attributes): self
    {
        $theme = new self();

        $theme->parseAttributes($attributes);

        return $theme;
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
