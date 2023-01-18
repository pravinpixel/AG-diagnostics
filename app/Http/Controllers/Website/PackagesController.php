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
        $packages = ManagePackage::where('status',1)->select('id','primaryId','packageName','icon','packageCode','cityId','cityName'
        ,'testLists','testSchedule','sampleType','ageRestrictions','preRequisties','reportAvailability','comments','fees','homeVisit'
        ,'discountFees','sorting_order','is_selected','meta_title','meta_description','meta_keyword')
        ->where('cityId','like',"%{$id}%")
        ->where('packageName','like',"%{$name}%")
        ->orderBy('sorting_order','asc')
        ->get();
        foreach($packages as $key=>$val)
        {
            $val['test_count'] = count(explode(",", $val['testLists']));
        }
        foreach($packages as $key=>$val)
        {
            if($val['icon'])
            {
                $val['icon'] = asset('public/'.$val['icon']);
            }
            else{
                $val['icon'] = asset('public/upload/packages/default_image/package_image.png');
            }
          
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
            $package_data = ManagePackage::find($request->packageId);
            $details = [
                'packageName'   => $package_data['packageName'],
                'name'          =>$request->name,
                'mobile'        =>$request->mobile,
                'email'         =>$request->email,
                'message'       =>$request->message,
                
            ];
            
            try{
                $sent_mail = "info@agdiagnostics.com";
                // $sent_mail = "santhoshd.pixel@gmail.com";
                Mail::to($sent_mail)->send(new PackagesMail($details));
            }catch(\Exception $e){
                $message = 'Package Enquiry Created Successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
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
        ->select('id','primaryId','packageName','icon','packageCode','cityId','cityName','testLists','testSchedule','sampleType','ageRestrictions',
        'preRequisties','reportAvailability','comments','fees','homeVisit','discountFees','is_selected','meta_title',
        'meta_description','meta_keyword','sorting_order')
        ->where('is_selected',1)
        ->where('cityId','like',"%{$id}%")
        ->orderBy('sorting_order','asc')
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
        $package_detail = ManagePackage::select('id','primaryId','icon','packageName','packageCode','cityId','cityName'
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
        $packages = ManagePackage::where('status',1)->select('id','primaryId','icon','packageName','packageCode','cityId','cityName'
        ,'fees','discountFees','sorting_order')
        ->where('cityId','like',"%{$id}%")
        ->where('packageName','like',"%{$name}%")
        ->orderBy('sorting_order','asc')
        ->get();
        $package_count = count($packages);
        return response()->json(['package_count'=>$package_count,'packages'=>$packages,'title'=>$title]);
    }
}
