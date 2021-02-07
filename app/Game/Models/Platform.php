<?php

namespace App\Game\Models;

class Platform extends GameModel
{
    /** @var string */
    private $abbreviation;

    public static function parse(array $attributes): self
    {
        $platform = new self();

        $platform->parseAttributes($attributes);

        return $platform;
    }

    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    public function setAbbreviation(string $abbreviation): void
    {
        $this->abbreviation = $abbreviation;
    }
}
