<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;

Route::get('/', fn() => redirect()->route('beranda'));

Route::get('/beranda', [LandingPageController::class, 'index'])
    ->name('beranda');