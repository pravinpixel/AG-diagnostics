<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\ManageTest;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $test = ManageTest::where('status',1)
        ->select('id','primaryId','testName','testCode','cityId','cityName','details','sample','container','qty','storage','method','comments','fees','homeVisit','discountFees')
        ->get();
        return response()->json(['test'=>$test]);
    }
}
