<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomPriceService;

class HomeController extends Controller
{
    // public function index()
    // {
    //     $properties = Property::with([
    //         'city',
    //         'rooms' => function ($q) {
    //             $q->where('status', 'available');
    //         }
    //     ])
    //         ->where('status', 1)
    //         ->get();

    //     $hotels = $properties->map(function ($property) {

    //         if ($property->rooms->isEmpty()) {
    //             return null;
    //         }

    //         // harga asli (base)
    //         $basePrice = $property->rooms->min('base_price');

    //         // harga final (promo aware)
    //         $finalPrice = $property->rooms
    //             ->map(fn($room) => RoomPriceService::getPrice($room))
    //             ->min();

    //         return [
    //             'name'        => $property->name,
    //             'city'        => $property->city->name ?? '-',
    //             'image'       => $property->thumbnail
    //                 ? asset('storage/' . $property->thumbnail)
    //                 : null,
    //             'price'       => $basePrice,
    //             'promo_price' => $finalPrice < $basePrice ? $finalPrice : null,
    //             'is_promo'    => $finalPrice < $basePrice,
    //             'url' => $property->public_url,
    //         ];
    //     })->filter(); // buang null

    //     return view('home', compact('hotels'));
    // }

    public function index(Request $request)
    {
        $properties = Property::with([
            'city',
            'rooms' => function ($q) use ($request) {
                $q->where('status', 'available');

                // filter kapasitas kamar
                if ($request->filled('guest')) {
                    $q->where('capacity', '>=', $request->guest);
                }
            }
        ])
            ->where('status', 1)

            // 🔍 filter kota / lokasi
            ->when($request->filled('kota'), function ($q) use ($request) {
                $q->whereHas('city', function ($city) use ($request) {
                    $city->where('name', 'like', '%' . $request->kota . '%');
                });
            })
            ->get();

        $hotels = $properties->map(function ($property) {

            if ($property->rooms->isEmpty()) {
                return null;
            }

            $basePrice = $property->rooms->min('base_price');

            $finalPrice = $property->rooms
                ->map(fn($room) => RoomPriceService::getPrice($room))
                ->min();

            return [
                'name'        => $property->name,
                'city'        => $property->city->name ?? '-',
                'image'       => $property->thumbnail
                    ? asset('storage/' . $property->thumbnail)
                    : 'https://placehold.co/600x400?text=Hotel',
                'price'       => $basePrice,
                'promo_price' => $finalPrice < $basePrice ? $finalPrice : null,
                'is_promo'    => $finalPrice < $basePrice,
                'url'         => $property->public_url,
            ];
        })->filter();

        /* ======================
        |  HOTEL PROMO (GLOBAL)
        ====================== */

        $promoProperties = Property::with(['city', 'rooms'])
            ->where('status', 1)
            ->whereHas('rooms', function ($q) {
                $q->where('status', 'available');
            })
            ->limit(6)
            ->get();

        $promoHotels = $promoProperties->map(function ($property) {
            $hotel = $this->mapHotel($property);
            return $hotel && $hotel['is_promo'] ? $hotel : null;
        })->filter();

        $cities = City::orderBy('name')->pluck('name');

        return view('home', compact('hotels', 'cities', 'promoHotels'));
    }

    private function mapHotel($property)
    {
        if ($property->rooms->isEmpty()) {
            return null;
        }

        $basePrice = $property->rooms->min('base_price');

        $finalPrice = $property->rooms
            ->map(fn($room) => RoomPriceService::getPrice($room))
            ->min();

        return [
            'name'        => $property->name,
            'city'        => $property->city->name ?? '-',
            'image'       => $property->thumbnail
                ? asset('storage/' . $property->thumbnail)
                : 'https://placehold.co/600x400?text=Hotel',
            'price'       => $basePrice,
            'promo_price' => $finalPrice < $basePrice ? $finalPrice : null,
            'is_promo'    => $finalPrice < $basePrice,
            'url'         => $property->public_url,
        ];
    }
}
