<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Area;
use App\Models\Website\Packages;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            $data = Packages::with('areas')->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()  
                ->addColumn('action', function ($data) {
                    return button('delete',route('enquiry_package.delete', $data->id));
                })
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
               
            ->rawColumns(['action','status','created_at'])
            ->make(true);
        }
        return view('admin.enquiry.packages.package');
    }
    public function delete($id = null)
    {
        $packages  = Packages::find($id);
        $packages->delete();
        Flash::success( __('action.deleted', ['type' => 'Packages']));
        return redirect()->back();
    }
}
