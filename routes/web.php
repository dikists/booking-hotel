<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Public\HotelController as PublicHotel;
use App\Http\Controllers\Partner\HotelController as PartnerHotel;
use App\Http\Controllers\Partner\RoomController as PartnerRoom;
use App\Http\Controllers\Partner\RoomPromoController as PartnerRoomPromo;
use App\Http\Controllers\Partner\RoomGalleryController as PartnerRoomGallery;

Route::get('/', [HomeController::class, 'index'])->name('home');

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

        // rooms
        Route::get('/hotel/{property}/rooms', [PartnerRoom::class, 'index'])
            ->name('hotel.rooms.index');

        // rooms create
        Route::get('/hotel/{property}/rooms/create', [PartnerRoom::class, 'create'])
            ->name('hotels.rooms.create');

        // rooms store
        Route::post('/hotel/{property}/rooms', [PartnerRoom::class, 'store'])
            ->name('hotels.rooms.store');

        // rooms edit
        Route::get('/hotel/{property}/rooms/{room}/edit', [PartnerRoom::class, 'edit'])
            ->name('hotels.rooms.edit');

        // rooms update
        Route::put('/hotel/{property}/rooms/{room}', [PartnerRoom::class, 'update'])
            ->name('hotels.rooms.update');

        // // rooms destroy
        // Route::delete('/hotel/{property}/rooms/{room}', [PartnerRoom::class, 'destroy'])
        //     ->name('hotels.rooms.destroy');

        // room price
        Route::get('/hotel/{property}/rooms/{room}/price', [PartnerRoom::class, 'price'])
            ->name('hotels.rooms.prices.index');

        // room promo
        Route::get(
            '/hotel/{property}/rooms/{room}/promos',
            [PartnerRoomPromo::class, 'index']
        )->name('hotels.rooms.promos.index');

        Route::get(
            '/hotel/{property}/rooms/{room}/promos/create',
            [PartnerRoomPromo::class, 'create']
        )->name('hotels.rooms.promos.create');

        Route::post(
            '/hotel/{property}/rooms/{room}/promos',
            [PartnerRoomPromo::class, 'store']
        )->name('hotels.rooms.promos.store');

        // room gallery
        Route::get(
            '/hotels/{property}/rooms/{room}/gallery',
            [PartnerRoomGallery::class, 'index']
        )->name('hotels.rooms.gallery.index');

        Route::post(
            '/hotels/{property}/rooms/{room}/gallery',
            [PartnerRoomGallery::class, 'store']
        )->name('hotels.rooms.gallery.store');

        // set foto utama kamar
        Route::patch(
            '/hotels/{property}/rooms/{room}/gallery/{gallery}/primary',
            [PartnerRoomGallery::class, 'setPrimary']
        )->name('hotels.rooms.gallery.primary');
        // hapus foto kamar
        Route::delete(
            '/hotels/{property}/rooms/{room}/gallery/{gallery}',
            [PartnerRoomGallery::class, 'destroy']
        )->name('hotels.rooms.gallery.destroy');
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
