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
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class HomeVisitController extends Controller
{
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'date' => 'required',
            'cityId' =>'required',
            'areaId' =>'nullable',
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
        $data->areaId               = $request->areaId ?? NULL;
        $data->first_name           = $request->first_name ;
        $data->email                = $request->email ;
        $data->mobile               = $request->mobile ;
        $data->address              = $request->address ;
        $data->date                 = $request->date ;
        $data->remark               = $request->remark ;
        if(!empty($request['packageId'])){
        $packageName        = [];
        // $package_split_data = str_replace(["[","]"],"",$request['packageId']);
        $package_explode_data = explode(",",$request['packageId']);
        foreach($package_explode_data as $key=>$val)
        {
            // $package_exploade_id = (explode(":",$val));
            $package_data= ManagePackage::select('packageName','fees')->find($val);
            array_push($packageName,"<td>".$package_data['packageName']."</td><td style='text-align:right'>".$package_data['fees']." ₹ </td>");
        };
        $packageName = json_encode($packageName);
        $data->packageId       = $packageName;

    }
    if(!empty($request['title'])){

        $testName          = [];

        // $test_split_data = str_replace(["[","]"],"",$request['title']);
        // $test_explode_data = explode(",",$test_split_data);
        $test_explode_data = explode(",",$request['title']);
        foreach($test_explode_data as $key=>$val)
        {
            // $test_exploade_id = (explode(":",$val));
            // $test_data= ManageTest::select('manage_tests.testName')->find($test_exploade_id[0]);
            $test_data= ManageTest::select('testName','fees')->find($val);
            array_push($testName,"<td>".$test_data['testName']."</td><td style='text-align:right'>".$test_data['fees']." ₹ </td>");
        }
        $testName = json_encode($testName);
        $data->title       = $testName;
    }
    $time = strtotime($request->date);
    
    $date = date('Y/m/d H:i:s', $time);
    
    $res = $data->save();
            if(isset($request->cityId) && isset($request->areaId))
            {
                $location = HomeVisitArea::where('cityId',$request->cityId)
                ->where('areaId',$request->areaId)
                ->first();
            }else{
                $location = HomeVisitArea::where('cityId',$request->cityId)
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
        //   $date =  HomeVisit::select('date')->find($data->id);
        //  $dd =  \Carbon\Carbon::parse($request->date)->format('Y-m-d\Th:i:sT');
         
            $details = [
                'packageName'   => $packageName,
                'test'          => $testName,
                'first_name'    =>$request->first_name,
                'email'         =>$request->email,
                'mobile'        =>$request->mobile,
                'address'       =>$request->address,
                'date'          =>$request->date,
                'remark'        =>$request->remark,
                'city'          =>$location['city']?? '',
                'area'          =>$location['area'] ?? '',
            ];

            $packageArrayData= [];
            $testArrayData= [];
            if(!empty($request->packageId))
            {
                $package_code = explode(',',$request->packageId);
                $packageCodeArray = ManagePackage::whereIn('id',$package_code)->select('packageCode')->get();
                foreach($packageCodeArray as $key=>$val){
                    $packageArrayData[] = $val['packageCode'];
                }
            }
            if(!empty($request->title))
            {
                $test_code = explode(',',$request->title);
                $testCodeArray = ManageTest::whereIn('id',$test_code)->select('testCode')->get();
                foreach($testCodeArray as $key=>$val){
                    $testArrayData[] = $val['testCode'];
                }

            }

           if(!empty($packageArrayData) || !empty($testArrayData) ){
            $testPackageCodes = array_merge($packageArrayData,$testArrayData);
           }else{
            $testPackageCodes= null;
           }

           if(empty($request->remark))
           {
            $tests = "";
           }else{
            $tests = $request->remark;
           }

           if(empty($request->address))
           {
            $address = "";
           }else{
            $address = $request->address;
           }
            $postInput = [
                'visitDt'               =>$request->date,
                'name'                  =>$request->first_name,
                'address'               =>$address,
                'areaId'                =>$request->areaId ?? '',
                'mobileNo'              =>$request->mobile,
                'tests'                 =>$tests,
                'testPackageCodes'      => $testPackageCodes,
            ];
            $apiResponse = clientApiDataPass($postInput);
            try{
                // $sent_mail = "info@agdiagnostics.com";
                $sent_mail = "websupport@pixel-studios.com";
                // $sent_mail = "santhoshd.pixel@gmail.com";
                // $bccEmails = "manikandan@pixel-studios.com";
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
