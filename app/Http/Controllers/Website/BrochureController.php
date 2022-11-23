<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brochure;
use Illuminate\Http\Request;

class BrochureController extends Controller
{
    // public function index()
    // {
    //     $data = Brochure::get();
    //     foreach($data as $key=>$val)
    //     {
    //         if($val['brochure'])
    //         {
    //             $val['brochure'] = asset('public/upload/brochure/'.$val['brochure']);

    //         }
    //     }
    //     return response()->json(['data'=>$data]);
    // }  
    public function index(Request $request)
    {
        $type = $request['type'];
        $brochure = Brochure::where('status',1)
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
        }

        return response()->json(['data'=>$brochure]);

    }

}
