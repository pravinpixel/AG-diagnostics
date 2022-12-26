<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brochure;
use Illuminate\Http\Request;

class BrochureController extends Controller
{
    
    public function index(Request $request)
    {
        $type = $request['type'];
        $brochure = Brochure::where('status',1)->select('id','title','brochure','image','type')
        ->when(!empty($type),function($q) use ($type){
            $q->where('type','=',$type);
        })
        ->get();
        foreach($brochure as $key=>$val)
        {
            if($val['brochure'])
            {
                $val['brochure'] = asset('public/upload/brochure/'.$val['brochure']);
            }
            if($val['image'])
            {
                $val['image'] = asset('public/upload/brochure_image/'.$val['image']);
            }
        }
        return response()->json(['data'=>$brochure]);
    }

}
