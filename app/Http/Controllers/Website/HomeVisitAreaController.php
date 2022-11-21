<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeVisit;
use App\Models\Admin\HomeVisitArea;
use Illuminate\Http\Request;

class HomeVisitAreaController extends Controller
{
    public function index()
    {
       $data = HomeVisitArea::where('status',1)->get();
       return response()->json(['data'=>$data]);
    }
}
