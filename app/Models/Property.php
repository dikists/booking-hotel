<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Services\RoomPriceService;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'partner_id',
        'name',
        'slug',
        'address',
        'province_id',
        'regency_id',
        'district_id',
        'latitude',
        'longitude',
        'status',
        'thumbnail',
    ];

    // public function partner()
    // {
    //     return $this->belongsTo(Partner::class);
    // }

    protected $appends = ['lowest_price'];

    public function getLowestPriceAttribute()
    {
        // Ambil room yang available saja
        $rooms = $this->rooms->where('status', 'available');

        if ($rooms->isEmpty()) {
            return null;
        }

        return $rooms->map(function ($room) {
            return RoomPriceService::getPrice($room);
        })->min();
    }

    public function getPublicUrlAttribute()
    {
        return route('hotel.show', [
            'country'  => 'indonesia',
            'province' => Str::slug($this->province->name),
            'city'     => Str::slug($this->city->name),
            'district' => Str::slug($this->district->name),
            'hotel'    => $this->slug,
        ]);
    }

    public function galleries()
    {
        return $this->hasMany(PropertyGallery::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'regency_id', 'id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
}
