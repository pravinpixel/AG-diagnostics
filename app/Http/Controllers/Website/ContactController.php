<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Contact;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use App\Mail\ContactUsMail;
use Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.contact_us.contact-us');

    }
    public function store(Request $requests)
    {
      
        $validator = Validator::make($requests->all(), [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|numeric|digits:10',
        ]);
        if ($validator->fails()) {
            return failedCall($validator->messages());
        }
      
        $data = new Contact;
        $data->name = $requests->name;
        $data->phone = $requests->phone;
        $data->email = $requests->email;
        $data->message = $requests->message;
        $data->status= 1;
        $res = $data->save();
        if($res)
        {
            $details = [
             
                'name'          =>$requests->name,
                'email'         =>$requests->email,
                'mobile'        =>$requests->phone,
                'message'       =>$requests->message,
                
            ];
            try{
                $sent_mail = "info@agdiagnostics.com";
                // $sent_mail = "santhoshd.pixel@gmail.com";

                Mail::to($sent_mail)->send(new ContactUsMail($details));
            }catch(\Exception $e){
                $message = 'Thanks for reach us, our team will get back to you shortly. Please setup your <a href="setting/mail_setting">mail setting</a> to send mail.';
                return response()->json(['Status'=>200,'Errors'=>false,'Message'=>$message]);
            }
        return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Thanks for reach us, our team will get back to you shortly']);

        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something  went wrong."]);
    }
}
