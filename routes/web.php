<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\SocialLoginController;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/hotel', [HotelController::class, 'index'])->middleware(['auth', 'verified'])->name('hotel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// login google
Route::get('/auth/google', [SocialLoginController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [SocialLoginController::class, 'callback']);

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn() => view('dashboard'))
        ->name('admin.dashboard');
});

Route::middleware(['auth', 'verified', 'role:partner'])->group(function () {
    Route::get('/partner/dashboard', fn() => view('partner.dashboard'))
        ->name('partner.dashboard');
});

Route::middleware(['auth', 'verified', 'role:customer'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index']);
});

// detail hotel
Route::get(
    '/hotel/{country}/{province}/{city}/{district}/{hotel}',
    [HotelController::class, 'show']
)->name('hotel.show');

require __DIR__ . '/auth.php';
