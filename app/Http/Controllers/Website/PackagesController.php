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
        $name = $request['package_name'];
        $packages = ManagePackage::where('status',1)->select('id','primaryId','packageName','packageCode','cityId','cityName'
        ,'testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit'
        ,'discountFees','is_selected','meta_title','meta_description','meta_keyword')
        ->where('cityId','like',"%{$id}%")
        ->where('packageName','like',"%{$name}%")
        ->get();
        foreach($packages as $key=>$val)
        {
            $val['test_count'] = count(explode(",", $val['testLists']));
        }
        $package_count = count($packages);
        return response()->json(['package_count'=>$package_count,'packages'=>$packages,'title'=>$title]);
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
        //    return successCall();
        return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Package Enquiry Created Successfully']);

        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
    public function selectedPackages(Request $request)
    {
        $title = "Packages";
        $id = $request['cityId'];
        $selectedPackages = ManagePackage::where('status',1)
        ->select('id','primaryId','packageName','packageCode','cityId','cityName','testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit','discountFees','is_selected','meta_title','meta_description','meta_keyword')
        ->where('is_selected',1)
        ->where('cityId','like',"%{$id}%")
        ->get();
        foreach($selectedPackages as $key=>$val)
        {
            $val['test_count'] = count(explode(",", $val['testLists']));
        }
        $package_count = count($selectedPackages);
        return response()->json(['package_count'=>$package_count,'selectedPackages'=>$selectedPackages]); 
    }
    public function packageDetails($id)
    {
        $package_detail = ManagePackage::select('id','primaryId','packageName','packageCode','cityId','cityName'
        ,'testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit'
        ,'discountFees','is_selected','meta_title','meta_description','meta_keyword')->find($id);
        $package_detail['test_count'] = count(explode(",", $package_detail['testLists']));
        if(!empty($package_detail))
        {
            return response()->json(['package_detail'=>$package_detail]);
        }
        else{
            return response()->json(['Message'=>"Data not Find"]);
        }
    }
    public function homeVisitPackageList(Request $request)
    {
        $title = "Packages";
        $id = $request['cityId'];
        $name = $request['package_name'];
        $packages = ManagePackage::where('status',1)->select('id','primaryId','packageName','packageCode','cityId','cityName'
        ,'fees','discountFees')
        ->where('cityId','like',"%{$id}%")
        ->where('packageName','like',"%{$name}%")
        ->get();
        $package_count = count($packages);
        return response()->json(['package_count'=>$package_count,'packages'=>$packages,'title'=>$title]);
    }
}
