<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Website\HomeVisit;
use App\Models\Admin\Area;
use App\Mail\HomeVisitMail;
use Facade\Ignition\Support\Packagist\Package;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class HomeVisitController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'packageId' => 'required|numeric',
            'first_name' => 'required|string',
            'mobile' => 'required|min:10|max:10',
        ]);
        
        if ($validator->fails()) {
            $error = 1;
            return response()->json(['error'=>$error,'message'=>$validator->messages()]);
        }
        $data = new HomeVisit;
        $data->packageId            = $request->packageId ;
        $data->title                = $request->title ;
        $data->first_name           = $request->first_name ;
        $data->last_name            = $request->last_name ;
        $data->email                = $request->email ;
        $data->gender               = $request->gender ;
        $data->mobile               = $request->mobile ;
        $data->dob                  = $request->dob ;
        $data->address              = $request->address ;
        $data->date                 = $request->date ;
        $data->timing               = $request->timing ;
        $res = $data->save();
        // dd($res);
        if($res)
        {
            $error = 0;
            return response()->json(['error'=>$error,'message'=>"Home Visit Store Successfully."]);
        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
}
