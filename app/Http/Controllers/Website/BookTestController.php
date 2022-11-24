<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Website\BookTest;
use App\Models\Admin\Area;
use Laracasts\Flash\Flash;
use App\Mail\BookTestMail;
use Yajra\DataTables\Facades\DataTables;
use Validator;

class BookTestController extends Controller
{
    public function index()
    {
        $area = Area::get();
        // dd("S");
        return view('website.book_a_test.book-test',compact('area'));

    }
    public function store(Request $requests)
    {
        // $this->validate($requests, [
        //     'full_name' => 'required',
        //     'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        //     'mobile' => 'required|min:10|max:10',
           
        // ]);
        $validator = Validator::make($requests->all(), [
            'full_name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile' => 'required|min:10|max:10',
        ]);
        if ($validator->fails()) {
            $error = 1;
            return response()->json(['error'=>$error,'message'=>$validator->messages()]);
        }
        $datetime = $requests->dateTime;
        $date = date('d-m-Y', strtotime($requests->dateTime));
        $time = date('H:i', strtotime($requests->dateTime));
        $date_time = $date." / ".$time;

        $data = new BookTest;
        $data->full_name = $requests->full_name;
        $data->mobile = $requests->mobile;
        $data->email = $requests->email;
        $data->area = $requests->area;
        $data->test = $requests->test;
        $data->visit = $requests->visit;
        $data->date = $date_time;
        $data->status= 1;
        $data->save();
        $area = Area::where('id',$requests->area)->select('area')->first();
        $details = [
            "name" => $requests->full_name,
            "mobile" => $requests->mobile,
            "email" => $requests->email,
            "area" => $area->area,
            "test" => $requests->test,
            "visit" => $requests->visit,
            "date" => $requests->dateTime,
            
        ];
        // bookTestMailFunction($details);
        // dd($requests->email);
        $emails = array("67santhosh@email.com", $requests->email);
        foreach ($emails as $email) {
        Mail::to($email)->send(new BookTestMail($details));
        }
        return view('website.book_a_test.thank-you');
        // return back()->with('success','Book a Test Successfully Added!');
    }
}
