<?php

namespace App\Game;

use App\Game\Models\Game;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Igdb
{
    private string $accessToken;

    private int $accessTokenExpiresIn;

    private Carbon $accessTokenRetrievedAt;

    public function __construct()
    {
        $this->retrieveAccessToken();
    }

    public function games(array $fields, string $where = '', array $sort = null, int $limit = 10): Collection
    {
        $response = Http::withHeaders($this->authHeaders())
            ->withBody($this->formatBody($fields, $where, $sort, $limit), 'text')
            ->acceptJson()
            ->post($this->url('games'))
            ->json();

        return collect($response)->map(static function ($game) {
            return Game::parse($game);
        });
    }

    public function game(array $fields, string $slug): Game
    {
        $where = 'slug = ' . $slug;

        $response = Http::withHeaders($this->authHeaders())
            ->withBody($this->formatBody($fields, $where), 'text')
            ->acceptJson()
            ->post($this->url('games'))
            ->json();

        return Game::parse($response);
    }

    protected function authHeaders(): array
    {
        return [
            'Client-ID' => config('igdb.client_key'),
            'Authorization'     => 'Bearer ' . $this->accessToken(),
        ];
    }

    protected function retrieveAccessToken(): void
    {
        $response = Http::post($this->twitchUrl('oauth2/token'), [
            'client_id' => config('igdb.client_key'),
            'client_secret' => config('igdb.secret'),
            'grant_type' => 'client_credentials',
        ])
            ->json();

        $this->accessToken = $response['access_token'];
        $this->accessTokenExpiresIn = $response['expires_in'];
        $this->accessTokenRetrievedAt = now();
    }

    protected function url(string $url): string
    {
        return $this->baseUrl() . '/' . $url;
    }

    protected function twitchUrl(string $url): string
    {
        return rtrim(config('igdb.twitch_base_url'), '/') . '/' . $url;
    }

    protected function baseUrl(): string
    {
        return rtrim(config('igdb.base_url'), '/');
    }

    protected function accessToken(): string
    {
        $expiresAt = $this->accessTokenRetrievedAt->addSeconds($this->accessTokenExpiresIn);

        if ($expiresAt->isBefore(now()->subHour())) {
            $this->retrieveAccessToken();
        }

        return $this->accessToken;
    }

    protected function formatBody(array $fields, string $where = '', array $sort = null, int $limit = 10): string
    {
        $body = [
            'fields ' . implode(',', $fields),
        ];

        if ($where) {
            $body[] = 'where ' . $where;
        }

        if ($sort) {
            $body[] = 'sort ' . $sort[0] . ' ' . $sort[1];
        }

        $body[] = 'limit ' . $limit;

        return implode('; ', $body) . ';';
    }
}
