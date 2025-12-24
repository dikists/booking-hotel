<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
     protected $fillable = [
        'partner_id',
        'name',
        'slug',
        'address',
        'province_id',
        'city_id',
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

    public function galleries()
    {
        return $this->hasMany(PropertyGallery::class);
    }

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
