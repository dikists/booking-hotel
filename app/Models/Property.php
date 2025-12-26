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
}
