<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use App\Models\Admin\Area;
use App\Mail\PackagesMail;
use App\Models\Admin\ManagePackage;
use App\Models\Website\Packages;
use Illuminate\Support\Facades\Mail;
use Validator;


class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $title = "Packages";
        $id = $request['cityId'];
        $packages = ManagePackage::where('status',1)->select('id','primaryId','packageName','packageCode','cityId','cityName','testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit','discountFees','is_selected','meta_title','meta_description','meta_keyword')
        ->when(!empty($id), function($q) use ($id){
            $q->where('cityId',$id);
        })
        ->get();
        return response()->json(['packages'=>$packages,'title'=>$title]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'packageId' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);
        if ($validator->fails()) {
            return failedCall($validator->messages());
        }
        $data = new Packages;
        $data->packageId = $request->packageId ;
        $data->name = $request->name ;
        $data->mobile = $request->mobile ;
        $data->email = $request->email ;
        $data->message = $request->message;
        $res = $data->save();
        if($res)
        {
           return successCall();
        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
    public function selectedPackages()
    {
        $selectedPackages = ManagePackage::where('status',1)
        ->select('id','primaryId','packageName','packageCode','cityId','cityName','testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit','discountFees','is_selected','meta_title','meta_description','meta_keyword')
        ->where('is_selected',1)->get();
        return response()->json(['selectedPackages'=>$selectedPackages]); 
    }
    
}
