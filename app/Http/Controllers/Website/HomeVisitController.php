<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Website\HomeVisit;
use App\Models\Admin\Area;
use App\Mail\HomeVisitMail;
use App\Models\Admin\HomeVisitArea;
use Facade\Ignition\Support\Packagist\Package;
use Laracasts\Flash\Flash;
use App\Models\Admin\ManagePackage;
use App\Models\Admin\ManageTest;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class HomeVisitController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'date' => 'required',
            'mobile' => 'required|numeric|digits:10',
        ]);
        if ($validator->fails()) {
            return failedCall($validator->messages());
        }
        // $packageId                  ="";
        // $title                      ="";
        // $package_amount             ="";
        // $test_amount                ="";
        $data = new HomeVisit;
        $data->cityId               = $request->cityId;
        $data->areaId               = $request->areaId;
        $data->first_name           = $request->first_name ;
        $data->email                = $request->email ;
        $data->mobile               = $request->mobile ;
        $data->address              = $request->address ;
        $data->date                 = $request->date ;
        $data->remark               = $request->remark ;
        if(!empty($request['packageId'])){
        $packageName        = [];
        $testName          = [];
        $package_split_data = str_replace(["[","]"],"",$request['packageId']);
        $package_explode_data = explode(",",$package_split_data);
        foreach($package_explode_data as $key=>$val)
        {
            $package_exploade_id = (explode(":",$val));
            $package_data= ManagePackage::select('manage_packages.packageName')->find($package_exploade_id[0]);
            array_push($packageName,"<td>".$package_data['packageName']."</td><td style='text-align:right'>".$package_exploade_id[1]." ₹ </td>");
        };

       
        // dd($packageName);
        $packageName = json_encode($packageName);
        $data->packageId       = $packageName;
       

    }
    if(!empty($request['title'])){

        $test_split_data = str_replace(["[","]"],"",$request['title']);
        $test_explode_data = explode(",",$test_split_data);
        foreach($test_explode_data as $key=>$val)
        {
            
            $test_exploade_id = (explode(":",$val));
            
            $test_data= ManageTest::select('manage_tests.testName')->find($test_exploade_id[0]);
            array_push($testName,"<td>".$test_data['testName']."</td><td style='text-align:right'>".$test_exploade_id[1]." ₹ </td>");
        };
        $testName = json_encode($testName);
        $data->title       = $testName;
    }
    $res = $data->save();


            if($request->cityId)
            {
                $location = HomeVisitArea::where('cityId',$request->cityId)
                ->where('areaId',$request->areaId)
                ->first();
            }
           if(empty($packageName))
           {
            $packageName = '';
           }
           if(empty($testName))
           {
            $testName = '';
           }
            $details = [
                'packageName'   => $packageName,
                'test'          => $testName,
                'first_name'    =>$request->first_name,
                'email'         =>$request->email,
                'mobile'        =>$request->mobile,
                'address'       =>$request->address,
                'date'          =>$request->date,
                'remark'        =>$request->remark,
                'city'          =>$location['city'],
                'area'          =>$location['area'],
                
            ];
            try{
                // $sent_mail = "info@agdiagnostics.com";
                $sent_mail = "santhoshd.pixel@gmail.com";
                Mail::to($sent_mail)->send(new HomeVisitMail($details));
            }catch(\Exception $e){
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
            return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Home Visit Booked Successfully']);       
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
}
