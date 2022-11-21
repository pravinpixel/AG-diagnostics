<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\RequestCallBack;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class RequestCallBackController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            $data = RequestCallBack::orderBy('id', 'DESC');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('created_at', function ($data) {
                    return date('d M Y', strtotime($data['created_at']));
                })
                ->addColumn('action', function ($data) {
                    return button('delete',route('enquiry_request_call.delete', $data->id));
                })
               
              
            ->rawColumns(['action','status','download'])
            ->make(true);
        }
        return view('admin.enquiry.request_call.request-call');
    }
    public function delete($id = null)
    {
        $careers  = RequestCallBack::find($id);
        $careers->delete();
        Flash::success( __('action.deleted', ['type' => 'Career']));
        return redirect()->back();
    }
}
