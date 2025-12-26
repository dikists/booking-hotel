<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'reg_regencies';
    protected $fillable = ['name', 'province_id'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'regency_id', 'id');
    }
}
