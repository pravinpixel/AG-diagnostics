<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Careers;
use Illuminate\Support\Facades\Mail;
use App\Mail\CareersMail;
use App\Mail\CareersAdminMail;
use App\Models\Admin\JobPost;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;
use Validator;


class CareersController extends Controller
{
    public function getJobDetail($id)
    {
        $jobDetail = JobPost::where('id',$id)->select('id','job_title','department_id','cityId','experience','education','job_purpose','responsibilities')
        ->with('city')->first();
        return response()->json(['job'=>$jobDetail]);
    }
    public function jobApply(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|min:10|max:10',
            'job_id' => 'required',
            'file'   => 'mimes:doc,pdf,docx'
        ]);
        if ($validator->fails()) {
            $error = 1;
            return response()->json(['error'=>$error,'message'=>$validator->messages()]);
        }

        $data = new Careers;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->job_id = $request->job_id;
        $data->address = $request->address;
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
            $error = 0;
            return response()->json(['error'=>$error,'message'=>"Career Successfully Added."]);
        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);

    }
}
