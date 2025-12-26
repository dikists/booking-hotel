<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'reg_districts';
    protected $fillable = ['regency_id', 'name'];

    public function city()
    {
        return $this->belongsTo(City::class, 'regency_id', 'id');
    }
}
