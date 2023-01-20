<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeVisit;
use App\Models\Admin\HomeVisitArea;
use Illuminate\Http\Request;

class HomeVisitAreaController extends Controller
{
    public function index(Request $request)
    {
        $cityId = $request['cityId'];

       $data = HomeVisitArea::where('status',1)
       ->select('id','areaId','area','cityId','city','stateId','state')
       ->where('cityId','like',"%{$cityId}%")
       ->get();
       $test_count = count($data);

       return response()->json(['count'=>$test_count,'data'=>$data]);
    }
}
