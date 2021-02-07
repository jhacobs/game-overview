<?php

namespace App\Game\Models;

class Company extends GameModel
{
    /** @var string */
    private $name;

    public static function parse(array $attributes): self
    {
        $company = new self();

        $company->parseAttributes($attributes);

        return $company;
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
