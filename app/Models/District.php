<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    protected $fillable = ['city_id', 'district_name', 'slug'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
