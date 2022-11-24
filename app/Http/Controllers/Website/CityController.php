<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {

        $city = City::where('status',1)->select('id','country_id','stateId','state','cityId','city','city_code','call_us','meta_title','meta_keyword','meta_description')->get();
        return response()->json(['city'=>$city]);
    } 
}
