<?php

namespace App\Game\Models;

class Game extends GameModel
{
    /** @var string */
    private $name;

    /** @var string */
    private $cover;

    /** @var string */
    private $totalRating;

    /** @var array */
    private $platforms;

    /** @var array */
    private $collection;

    /** @var array */
    private $expansions;

    /** @var string */
    private $firstReleaseDate;

    /** @var Franchise */
    private $franchise;

    /** @var array */
    private $involvedCompanies;

    /** @var string */
    private $status;

    /** @var string */
    private $storyline;

    /** @var string */
    private $summary;

    /** @var array */
    private $themes;

    /** @var string */
    private $slug;

    public static function parse(array $attributes): self
    {
        $game = new self();

        $game->parseAttributes($attributes);

        return $game;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getTotalRating()
    {
        return $this->totalRating;
    }

    public function getPlatforms()
    {
        return $this->platforms;
    }

    public function getCollection()
    {
        return $this->collection;
    }

    public function getExpansions()
    {
        return $this->expansions;
    }

    public function getFirstReleaseDate()
    {
        return $this->firstReleaseDate;
    }

    public function getFranchise()
    {
        return $this->franchise;
    }

    public function getInvolvedCompanies()
    {
        return $this->involvedCompanies;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStoryline()
    {
        return $this->storyline;
    }

    public function getSummary()
    {
        return $this->summary;
    }

    public function getThemes()
    {
        return $this->themes;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setCover(array $cover): void
    {
        $this->cover = bigImage($cover['url']);
    }

    public function setTotalRating(string $totalRating): void
    {
        $this->totalRating = $totalRating;
    }

    public function setPlatforms(array $platforms): void
    {
        $this->platforms = [];

        foreach ($platforms as $platform) {
            $this->platforms[] = Platform::parse($platform);
        }
    }

    public function setCollection(array $collection): void
    {
        $this->collection = Collection::parse($collection);
    }

    public function setExpansions(array $expansions): void
    {
        $this->expansions = [];

        foreach ($expansions as $expansion) {
            $this->expansions[] = self::parse($expansion);
        }
    }

    public function setFirstReleaseDate(string $firstReleaseDate): void
    {
        $this->firstReleaseDate = $firstReleaseDate;
    }

    public function setFranchise(array $franchise): void
    {
        $this->franchise = Franchise::parse($franchise);
    }

    public function setInvolvedCompanies(array $involvedCompanies): void
    {
        $this->involvedCompanies = [];

        foreach ($involvedCompanies as $company) {
            $this->involvedCompanies[] = Company::parse($company);
        }
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setStoryline(string $storyline): void
    {
        $this->storyline = $storyline;
    }

    public function setSummary(string $summary): void
    {
        $this->summary = $summary;
    }

    public function setThemes(array $themes): void
    {
        $this->themes = [];

        foreach ($themes as $theme) {
            $this->themes[] = Theme::parse($theme);
        }
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function getFormattedPlatforms(): string
    {
        return implode(', ', collect($this->getPlatforms())->map->getAbbreviation());
    }

    public function getFormattedExpansions(): string
    {
        return implode(', ', collect($this->getExpansions())->map->getName());
    }

    public function getFormattedInvolvedCompanies(): string
    {
        return implode(', ', collect($this->getInvolvedCompanies())->map->getName());
    }
}
