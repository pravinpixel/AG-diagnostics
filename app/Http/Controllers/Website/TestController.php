<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageTest;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $title = "Packages";
        $id = $request['cityId'];
        $search = $request['search'];
        $test = ManageTest::where('status',1)->select('id','primaryId','testName','testCode','cityId','cityName','details','sample','container','qty','storage',
        'method','comments','fees','homeVisit','discountFees')
        ->where('cityId','like',"%{$id}%")
        ->where('testName','like',"%{$search}%")
        ->get();
        $test_count = count($test);
        return response()->json(['test_count'=>$test_count,'test'=>$test]);
    }
}
