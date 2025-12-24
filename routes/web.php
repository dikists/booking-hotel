<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Public\HotelController as PublicHotel;
use App\Http\Controllers\Partner\HotelController as PartnerHotel;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/hotel', [PartnerHotel::class, 'index'])->middleware(['auth', 'verified'])->name('hotel');

// PARTNER
Route::middleware(['auth', 'verified', 'role:partner'])
    ->prefix('partner')
    ->name('partner.')
    ->group(function () {

        Route::get('/hotel', [PartnerHotel::class, 'index'])
            ->name('hotel.index');

        Route::get('/hotel/create', [PartnerHotel::class, 'create'])
            ->name('hotel.create');

        Route::post('/hotel', [PartnerHotel::class, 'store'])
            ->name('hotel.store');

        // edit
        Route::get('/hotel/{property}/edit', [PartnerHotel::class, 'edit'])
            ->name('hotel.edit');

        // hapus
        Route::delete('/hotel/{property}', [PartnerHotel::class, 'destroy'])
            ->name('hotel.destroy');

        // update
        Route::put('/hotel/{property}', [PartnerHotel::class, 'update'])
            ->name('hotel.update');
    });

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
    [PublicHotel::class, 'show']
)->name('hotel.show');


// get location
Route::get('/get-cities/{province}', [LocationController::class, 'getCities']);
Route::get('/get-districts/{city}', [LocationController::class, 'getDistricts']);

require __DIR__ . '/auth.php';
