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
        // if($request->packageId)
        // {
        //     $packageId                  =   json_encode($request->packageId);
        //     $data->packageId            = $packageId;
        // }
        // if($request->title)
        // {   
        //     $title                      =   json_encode($request->title);
        //     $data->title                = $title ;
        // }

        // if($request->package_amount)
        // {   
        //     $package_amount             =   json_encode($request->package_amount);
        //     $data->package_amount       = $package_amount;

        // }
        // if($request->test_amount)
        // {   
        //     $test_amount                =   json_encode($request->test_amount);
        //     $data->test_amount          = $test_amount;
        // }
        $data->packageId            = $request->packageId;
        $data->title                = $request->title;
        $data->cityId               = $request->cityId;
        $data->areaId               = $request->areaId;
        $data->first_name           = $request->first_name ;
        // $data->last_name            = $request->last_name ;
        $data->email                = $request->email ;
        // $data->gender               = $request->gender ;
        $data->mobile               = $request->mobile ;
        // $data->dob                  = $request->dob ;
        $data->address              = $request->address ;
        $data->date                 = $request->date ;
        // $data->timing               = $request->timing ;
        $data->remark               = $request->remark ;
        $res = $data->save();
        if($res)
        {
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

        $test_split_data = str_replace(["[","]"],"",$request['title']);
        $test_explode_data = explode(",",$test_split_data);
        foreach($test_explode_data as $key=>$val)
        {
            
            $test_exploade_id = (explode(":",$val));
            
            $test_data= ManageTest::select('manage_tests.testName')->find($test_exploade_id[0]);
            array_push($testName,"<td>".$test_data['testName']."</td><td style='text-align:right'>".$test_exploade_id[1]." ₹ </td>");
        };
            // if($request->packageId)
            // {
            //     foreach($request->packageId as $key=>$val)
            //     {
            //         $package_data = ManagePackage::select('manage_packages.packageName')->find($val);
            //         array_push($packageName,$package_data['packageName']);
            //     }
            //     foreach($request->package_amount as $key=>$val)
            //     {
            //         array_push($packageAmount,$val);
            //     } 
               
            // }
            // if($request->title)
            // {
            //     foreach($request->title as $key=>$val)
            //     {
            //         $package_data = ManageTest::select('manage_tests.testName')->find($val);
            //         array_push($testTitle,$package_data['testName']);
            //     } 
            //     foreach($request->test_amount as $key=>$val)
            //     {
            //         array_push($testAmount,$val);
            //     } 
            // }

            if($request->cityId)
            {
                $location = HomeVisitArea::where('cityId',$request->cityId)
                ->where('areaId',$request->areaId)
                ->first();
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
                $sent_mail = "santhoshd.pixel@gmail.com";
                Mail::to($sent_mail)->send(new HomeVisitMail($details));
            }catch(\Exception $e){
                $message = 'Data inserted successfully. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
            return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Home Visit Booked Successfully']);
        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
}
