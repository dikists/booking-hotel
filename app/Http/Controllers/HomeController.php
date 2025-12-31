<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\RoomPriceService;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::with([
            'city',
            'rooms' => function ($q) {
                $q->where('status', 'available');
            }
        ])
            ->where('status', 1)
            ->get();

        $hotels = $properties->map(function ($property) {

            if ($property->rooms->isEmpty()) {
                return null;
            }

            // harga asli (base)
            $basePrice = $property->rooms->min('base_price');

            // harga final (promo aware)
            $finalPrice = $property->rooms
                ->map(fn($room) => RoomPriceService::getPrice($room))
                ->min();

            return [
                'name'        => $property->name,
                'city'        => $property->city->name ?? '-',
                'image'       => $property->thumbnail
                    ? asset('storage/' . $property->thumbnail)
                    : null,
                'price'       => $basePrice,
                'promo_price' => $finalPrice < $basePrice ? $finalPrice : null,
                'is_promo'    => $finalPrice < $basePrice,
                'url' => $property->public_url,
            ];
        })->filter(); // buang null

        return view('home', compact('hotels'));
    }
}
