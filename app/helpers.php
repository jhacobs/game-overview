<?php

use Illuminate\Support\Str;

if (! function_exists('bigImage')) {
    function bigImage(string $url): string
    {
        return Str::replaceFirst('thumb', 'cover_big', $url);
    }
}
