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


class CareersController extends Controller
{
    public function getJobDetail($id)
    {
        $jobDetail = JobPost::where('id',$id)->with('city')->first();
        return response()->json(['job'=>$jobDetail]);
    }
    public function jobApply(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|min:10|max:10',
            'job_id' => 'required',
            'file'   => 'mimes:doc,pdf,docx'
        ]);
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
    //     $details = [
    //         "name" => $request->name,
    //         "phone" => $request->phone,
    //         "email" => $request->email,
    //         "job_id" => $request->job_id,
    //     ];
    //     $details_admin = [
    //         "name" => $request->name,
    //         "phone" => $request->phone,
    //         "email" => $request->email,
    //         "job_id" => $request->job_id,
    //         'attachment'=>$attachement
    //     ];
    //     // $emails = array("67santhosh@email.com", $request->email);
    //     // Mail::to($request->email)->send(new CareersMail($details));
    //     // Mail::to("67santhosh@email.com")->send(new CareersAdminMail($details_admin));
    //     // return view('website.career.thank-you');
        if($res)
        {
            $error = 1;
            return response()->json(['error'=>$error,'message'=>"Career Successfully Added."]);
        }
        $error = 0;
        return response()->json(['error'=>$error,'message'=>"something went wrong."]);

    }
}
