<section>
    <h2 class="text-primary mb-8 text-xl">Populaire games</h2>
    <div class="grid grid-cols-5">
        @foreach($games as $game)
            <x-game-card :cover="$game->getCover()" :name="$game->getName()" :platforms="$game->getPlatforms()"></x-game-card>
        @endforeach
    </div>
</section>
