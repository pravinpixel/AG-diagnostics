<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Contact;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.contact_us'))
        {
        if($request->ajax()) {
            $data = Contact::select('*')->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                       
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';

                    if($user->hasAccess('user.delete.contact_us'))
                    $delete =  button('delete',route('contact_us.delete', $data->id));
                    return $delete;
                })
             
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('contact_us.status', $data->id),$data);
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.enquiry.contact_us.contact-us');
        }
        else
        {
            if($user->hasAccess('user.view.home_visit')){
                return redirect()->route('home_visit.index');
            }
            else if($user->hasAccess('user.view.packages'))
            {
                return redirect()->route('enquiry_package.index');
            }
            // else if($user->hasAccess('user.view.test_booking'))
            // {
            //     return redirect()->route('book_test.index');
            // }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function delete($id = null)
    {
        $contact  = Contact::find($id);
        $contact->delete();
        Flash::success( __('action.deleted', ['type' => 'Contact']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $contact  = Contact::find($request->id);
        if($request->val == 1)
        {
            $contact->status = 0;
            $contact->save();
        }
        else{
            $contact->status = 1;
            $contact->save();
        }
        Flash::success( __('action.status', ['type' => 'Contact']));

    }
}
