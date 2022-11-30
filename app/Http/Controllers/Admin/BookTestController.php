<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\BookTest;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class BookTestController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.test_booking'))
        {
        if($request->ajax()) {
            $data = BookTest::with('areas')->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                // ->addColumn('areaName', function($data){
                //     return $data->areas->area;
                // })         
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';
                    $delete = button('delete',route('book_test.delete', $data->id));
                    return  $delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('book_test.status', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.enquiry.book_test.index');
        }
        else{
            if($user->hasAccess('user.view.home_visit')){
                return redirect()->route('home_visit.index');
            }
            else if($user->hasAccess('user.view.packages'))
            {
                return redirect()->route('enquiry_package.index');
            }
            else if($user->hasAccess('user.view.contact_us'))
            {
                return redirect()->route('contact_us.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function delete($id = null)
    {
        $booktest  = BookTest::find($id);
        $booktest->delete();
        Flash::success( __('action.deleted', ['type' => 'Book a test']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $booktest  = BookTest::find($request->id);
        if($request->val == 1)
        {
            $booktest->status = 0;
            $booktest->save();
        }
        else{
            $booktest->status = 1;
            $booktest->save();
        }
        Flash::success( __('action.status', ['type' => 'Book a test']));

    }
}
