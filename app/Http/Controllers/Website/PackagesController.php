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


class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $title = "Packages";
        $id = $request['cityId'];
        $packages = ManagePackage::where('status',1)
        ->when(!empty($id), function($q) use ($id){
            $q->where('cityId',$id);
        })
        ->get();
        return response()->json(['packages'=>$packages,'title'=>$title]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile' => 'required|max:10',
            'packageId' => 'required',
        ]);
       
        $data = new Packages;
        $data->packageId = $request->packageId ;
        $data->name = $request->name ;
        $data->mobile = $request->mobile ;
        $data->email = $request->email ;
        $data->message = $request->message;
        $res = $data->save();
        //    $details = [
        //     "name" => $request->full_name,
        //     "mobile" => $request->mobile,
        //     "email" => $request->email,
        //     "message" => $request->message,
            
        // ];
        //     $emails = array("67santhosh@email.com", $request->email);
        //     foreach ($emails as $email) {
        //    Mail::to($email)->send(new PackagesMail($details));
        //     }
   
        if($res)
        {
            $error = 0;
            return response()->json(['error'=>$error,'message'=>"Packages Store Successfully."]);
        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);


    }
    public function selectedPackages()
    {
        $selectedPackages = ManagePackage::where('status',1)->where('is_selected',1)->get();
        return response()->json(['selectedPackages'=>$selectedPackages]); 
    }
    
}
