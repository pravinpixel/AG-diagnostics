<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ManageLab;
use App\Models\Admin\Area;
use DB;

class FindLabController extends Controller
{
    public function findLab()
    {

    $data = ManageLab::with('country','area','state','city')->orderBy('lab_name', 'DESC')->get();
    $area_id = ManageLab::select('area_id')->groupBy('area_id')->get()->toArray();
    $area = Area::whereIn('id',$area_id)->get()->toArray();
       return view('website.find_lab.find-lab',compact('data','area'));
    }
}
