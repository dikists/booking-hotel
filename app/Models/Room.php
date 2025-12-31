<?php

namespace App\Models;

use App\Services\RoomPriceService;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $fillable = [
        'property_id',
        'room_name',
        'base_price',
        'capacity',
        'status',
    ];
    protected $appends = ['final_price'];

    public function getFinalPriceAttribute()
    {
        return RoomPriceService::getPrice($this);
    }

    public function getThumbnailAttribute()
    {
        if ($this->relationLoaded('primaryImage') && $this->primaryImage) {
            return asset('storage/' . $this->primaryImage->image);
        }

        return 'https://placehold.co/600x400?text=Room';
    }

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function activePromo()
    {
        return $this->hasOne(Promotion::class)
            ->where('is_active', true)
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now());
    }

    public function galleries()
    {
        return $this->hasMany(RoomGallery::class)->orderBy('sort_order');
    }

    public function primaryImage()
    {
        return $this->hasOne(RoomGallery::class)
            ->where('is_primary', true);
    }
}
