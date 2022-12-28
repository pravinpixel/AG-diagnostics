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
        //    return successCall();
        return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Thanks for reach us, our team will get back to you shortly']);

        }
        $error = 1;
        return response()->json(['error'=>$error,'message'=>"something  went wrong."]);
    }
}
