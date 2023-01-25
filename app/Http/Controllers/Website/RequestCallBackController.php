<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\RequestCallBack;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use App\Mail\RequestCallBackMail;
use Yajra\DataTables\Facades\DataTables;

class RequestCallBackController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'name' =>'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile' => 'required|max:10',
        ]);
        $data = new RequestCallBack;
        $data->name = $request->name;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->remarks = $request->remarks;
        $data->test = $request->test;
        $data->save();
        $details = [
            "name" => $request->name,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "remarks" => $request->remarks,
            "test" => $request->test,
        ];
        $emails = array("67santhosh@email.com", $request->email);
        $bccEmails = "manikandan@pixel-studios.com";
        foreach ($emails as $email) {
            Mail::to($email)->bcc($bccEmails)->send(new RequestCallBackMail($details));
        }
        // Mail::to($request->email)->send(new RequestCallBackMail($details));
        return view('website.request_call.thank-you');
        // return back()->with('success','Request a Call Back Successfully Added!');
    }
}
