<?php

namespace App\Http\Controllers;

use App\Game\Igdb;
use Illuminate\Contracts\View\View;

class OverviewController extends Controller
{
    protected Igdb $api;

    public function __construct()
    {
        $this->api = resolve(Igdb::class);
    }

    public function index(): View
    {
        return view('pages.home');
    }
}
