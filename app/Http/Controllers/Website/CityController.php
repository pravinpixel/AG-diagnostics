<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $city = City::where('status',1)->get();
        return response()->json(['city'=>$city]);
    } 
}
