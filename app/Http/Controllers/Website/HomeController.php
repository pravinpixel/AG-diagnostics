<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Area;

use App\Models\Admin\Testimonial;


class HomeController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::orderBy('date', 'DESC')->get();
        $area = Area::get();

        return view('website.home',compact('testimonial','area'));
    }
}
