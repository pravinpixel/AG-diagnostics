<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonial = Testimonial::where('status',1)
        ->select('id','title','date','type','description','video_url','photo','video_cover_image','given_by','designation')
        ->get();
        foreach($testimonial as $key=>$val)
        {
            if($val['photo'])
            {
            $val['photo'] = asset($val['photo']);
            }
        }
        return response()->json(['testimonial'=>$testimonial]);
    }
}
