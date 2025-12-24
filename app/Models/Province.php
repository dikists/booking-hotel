<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['province_name'];
    protected $table = 'provinces';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
