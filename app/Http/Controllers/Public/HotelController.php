<?php

namespace App\Http\Controllers\Public;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomPriceService;
use App\Http\Controllers\Controller;

class HotelController extends Controller
{
    public function show(
        string $country,
        string $province,
        string $city,
        string $district,
        string $hotel
    ) {
        $property = Property::with([
            'province',
            'city',
            'district',
            'galleries',
            'rooms.activePromo',
            'rooms.primaryImage',
            'rooms.galleries',
        ])
            ->where('slug', $hotel)
            ->where('status', true)
            ->firstOrFail();

        /**
         * Validasi manual URL wilayah
         * (biar SEO URL tetap rapi & aman)
         */
        if (
            Str::slug($property->province->name) !== $province ||
            Str::slug($property->city->name) !== $city ||
            Str::slug($property->district->name) !== $district
        ) {
            abort(404);
        }

        // mapping kamar + harga final
        $rooms = $property->rooms->map(function ($room) {
            $finalPrice = RoomPriceService::getPrice($room);

            return [
                'id'          => $room->id,
                'name'        => $room->room_name,
                'capacity'    => $room->capacity,
                'base_price'  => $room->base_price,
                'final_price' => $finalPrice,
                'is_promo'    => $finalPrice < $room->base_price,
                'image'       => $room->thumbnail,
                'gallery'     => $room->galleries->map(fn($img) => asset('storage/' . $img->image)),
            ];
        });


        return view('hotel.show', [
            'property' => $property,
            'property_galleries' => $property->galleries,
            'rooms'    => $rooms,
            'breadcrumb' => [
                'country'  => 'Indonesia',
                'province' => $property->province->name,
                'city'     => $property->city->name,
                'district' => $property->district->name,
                'hotel'    => $property->name,
            ]
        ]);
    }
}
