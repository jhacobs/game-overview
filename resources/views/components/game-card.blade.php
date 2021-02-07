<article class="w-32 mr-4 mb-4 last:mr-0">
    <div @click="modalOpen = true" role="button">
        <img src="{{ $cover }}" alt="Game afbeelding">
    </div>

    <p class="mt-4 font-bold text-white">{{ $name }}</p>

    <ul class="mt-4 flex flex-wrap">
        @isset($platforms)
            @foreach($platforms as $key => $platform)
                <li class="font-light mt-1 text-gray-300">{{ $platform->getAbbreviation() }} @if($key + 1 !== count($platforms)),&nbsp;@endif</li>
            @endforeach
        @endisset
    </ul>
</article>
