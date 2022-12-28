<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Area;
use App\Models\Website\Packages;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.packages'))
        {
        if($request->ajax()) {
            $data = Packages::with('areas')->select('*')->orderBy('created_at','desc');
            return DataTables::eloquent($data)
                ->addIndexColumn()  
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';

                    if($user->hasAccess('user.delete.packages'))
                    $delete = button('delete',route('enquiry_package.delete', $data->id));
                    return $delete;
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
               
            ->rawColumns(['action','status','created_at'])
            ->make(true);
        }
        return view('admin.enquiry.packages.package');
        }
        else
        {
            if($user->hasAccess('user.view.home_visit')){
                return redirect()->route('home_visit.index');
            }
            else if($user->hasAccess('user.view.contact_us'))
            {
                return redirect()->route('contact_us.index');
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
        $packages  = Packages::find($id);
        $packages->delete();
        Flash::success( __('action.deleted', ['type' => 'Packages']));
        return redirect()->back();
    }
}
