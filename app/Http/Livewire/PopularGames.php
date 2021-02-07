<?php

namespace App\Http\Livewire;

use App\Game\Igdb;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class PopularGames extends Component
{
    protected Collection $games;

    private Igdb $api;

    public function __construct($id = null)
    {
        parent::__construct($id);

        $this->api = resolve(Igdb::class);
        $this->games = collect([]);
    }

    public function mount(): void
    {
        $this->load();
    }

    public function load(): void
    {
        $this->games = Cache::remember('igdb.games', now()->addDay(), function () {
            return $this->api->games(
                [
                    'name',
                    'cover.url',
                    'total_rating',
                    'platforms.abbreviation',
                    'slug',
                ],
                'platforms = (48,49,130,6) & total_rating != null & cover != null',
                ['total_rating_count', 'desc']
            );
        });
    }

    public function render()
    {
        return view('livewire.popular-games', [
            'games' => $this->games,
        ]);
    }
}
