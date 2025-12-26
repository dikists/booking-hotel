<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];
    protected $table = 'reg_provinces';

    public function cities()
    {
        return $this->hasMany(City::class);
    }
}
