<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomGallery extends Model
{
    protected $fillable = [
        'room_id',
        'image',
        'is_primary',
        'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
