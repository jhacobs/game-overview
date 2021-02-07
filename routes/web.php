<?php

use App\Http\Controllers\OverviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [OverviewController::class, 'index']);
