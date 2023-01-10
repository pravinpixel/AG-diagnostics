<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Careers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareersMail;
use App\Models\Admin\JobPost;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Validator;


class CareersController extends Controller
{
    public function getJobDetail($id)
    {
        $jobDetail = JobPost::where('job_posts.id',$id)
        ->select('job_posts.id','job_posts.job_title','job_posts.department_id','job_posts.experience','job_posts.education',
        'job_posts.job_purpose','job_posts.responsibilities','job_posts.posts','departments.name as department_name','cities.cityId',
        'cities.city','cities.stateId','cities.state')
        ->leftJoin('departments','departments.id','job_posts.department_id')
        ->leftJoin('cities','cities.cityId','=','job_posts.cityId')
        ->first();
        if(!empty($jobDetail))
        {
            return response()->json(['job'=>$jobDetail]);
        }
        else{
            return response()->json(['Message'=>"Data not Find"]);
        }
    }
    public function jobApply(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'job_id' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|numeric|digits:10',
            'file'   => 'required|mimes:doc,pdf,docx'
        ]);
        if ($validator->fails()) {
            return failedCall($validator->messages());
        }

        $data = new Careers;
        $data->job_id = $request->job_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->location = $request->location;
        $data->cover_letter = $request->cover_letter;
        
        if($request->file)
        {
            $filePath = 'website/upload/careers';
            $path = public_path($filePath); 
            if(!file_exists($path))
            {
                mkdir($path, 0777, true);
            }
                
            if($request->hasfile('file'))
            {
                    $file = $request->file('file');
                    
                    if($file->extension() == "pfd" || "doc" || "docx")
                    {
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('website/upload/careers'), $name);  
                    $attachPath= public_path('website/upload/careers');
                    $attachement =  $attachPath.'/'.$name;
                    }
            }
            $data->file = $name;
        }
        $res = $data->save();
    if($res)
        {
            $jobData  = JobPost::find($request->job_id);
            $details = [
                'name'                  =>$request->name,
                'email'                 =>$request->email,
                'phone'                 =>$request->phone,
                'job'                   =>$jobData['job_title'],
                'address'               =>$request->address,
                'location'              =>$request->location,
                'cover_letter'          =>$request->cover_letter,
                
            ];
            try{
                // $sent_mail = "info@agdiagnostics.com";
                $sent_mail = "santhoshd.pixel@gmail.com";

                Mail::to($sent_mail)->send(new CareersMail($details));
            }catch(\Exception $e){
                $message = 'Thanks for reach us, our team will get back to you shortly. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
            return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Thank you for Applying']);

        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);

    }
}
