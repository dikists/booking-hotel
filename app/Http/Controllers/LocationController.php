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
            ->orderBy('city_name')
            ->get(['id', 'city_name']);
    }

    public function getDistricts($cityId)
    {
        return District::where('city_id', $cityId)
            ->orderBy('district_name')
            ->get(['id', 'district_name']);
    }
}
