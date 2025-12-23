<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function show(){
        return view('hotel.show');
    }
}
