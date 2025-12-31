<?php

namespace App\Services;

use App\Models\Room;
use App\Models\Promotion;
use Carbon\Carbon;

class RoomPriceService
{
    public static function getPrice(Room $room, $date = null): float
    {
        $date = Carbon::parse($date ?? now())->toDateString();

        $promo = self::getActivePromo($room, $date);

        return self::calculatePrice(
            $room->base_price,
            $promo
        );
    }

    protected static function getActivePromo(Room $room, string $date): ?Promotion
    {
        return Promotion::where('is_active', true)
            ->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date)
            ->where(function ($q) use ($room) {
                $q->where('room_id', $room->id)
                    ->orWhere(function ($q) use ($room) {
                        $q->whereNull('room_id')
                            ->where('property_id', $room->property_id);
                    });
            })
            ->orderByRaw('room_id IS NULL') // room promo > property promo
            ->first();
    }

    protected static function calculatePrice(float $basePrice, ?Promotion $promo): float
    {
        if (!$promo) {
            return $basePrice;
        }

        if ($promo->discount_type === 'percent') {
            $discount = $basePrice * ($promo->discount_value / 100);
        } else {
            $discount = $promo->discount_value;
        }

        return max($basePrice - $discount, 0);
    }
}
