<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\District;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCities($provinceId)
    {
        return City::where('province_id', $provinceId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function getDistricts($cityId)
    {
        return District::where('regency_id', $cityId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }
}
