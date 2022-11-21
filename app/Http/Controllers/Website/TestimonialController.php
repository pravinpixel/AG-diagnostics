<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::where('status',1)->get();
        return response()->json(['testimonial'=>$testimonial]);
    }
}
