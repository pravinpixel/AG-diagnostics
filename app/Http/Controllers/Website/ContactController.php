<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Contact;
use Illuminate\Support\Facades\Mail;
use Laracasts\Flash\Flash;
use App\Mail\ContactUsMail;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    public function index()
    {
        return view('website.contact_us.contact-us');

    }
    public function store(Request $requests)
    {
        $this->validate($requests, [
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'phone' => 'required|min:10|max:10',
        ]);
        $data = new Contact;
        $data->name = $requests->name;
        $data->phone = $requests->phone;
        $data->email = $requests->email;
        $data->message = $requests->message;
        $data->status= 1;
        $res = $data->save();
        // $details = [
        //     "name" => $requests->full_name,
        //     "phone" => $requests->phone,
        //     "email" => $requests->email,
        //     "message" => $requests->message,
        // ];
        // $emails = array("67santhosh@email.com", $requests->email);
        // foreach ($emails as $email) {
        // Mail::to($email)->send(new ContactUsMail($details));
        // }
        // return view('website.contact_us.thank-you');
        if($res)
        {
            $error = 1;
            return response()->json(['error'=>$error,'message'=>"Contact Store Successfully."]);
        }
        $error = 0;
        return response()->json(['error'=>$error,'message'=>"something  went wrong."]);
    }
}
