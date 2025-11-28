<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManageUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;


Route::get('/', fn() => redirect()->route('beranda'));

Route::get('/beranda', [LandingPageController::class, 'index'])
    ->name('beranda');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',[ManageUserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['superuser','auth'])->group(function () {
    Route::post('/admin/users/{id}/verify', [ManageUserController::class, 'verify'])->name('admin.user.verify');
});

require __DIR__.'/auth.php';

