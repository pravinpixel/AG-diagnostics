<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\Contact;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class ContactUsController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            $data = Contact::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                       
                ->addColumn('action', function ($data) {
                    return button('delete',route('contact_us.delete', $data->id));
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
