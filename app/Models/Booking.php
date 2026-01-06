<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';
    protected $fillable = [
        'booking_code',
        'user_id',
        'property_id',
        'room_id',
        'checkin_date',
        'checkout_date',
        'total_price',
        'booking_status',
        'expired_at',
        'checkin_at',
        'checkout_at',
        'checkin_by',
        'checkout_by',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
