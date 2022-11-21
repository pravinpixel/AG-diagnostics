<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website\BookTest;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class BookTestController extends Controller
{
    public function index(Request $request)
    {
        
        if($request->ajax()) {
            $data = BookTest::with('areas')->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                // ->addColumn('areaName', function($data){
                //     return $data->areas->area;
                // })         
                ->addColumn('action', function ($data) {
                    return button('delete',route('book_test.delete', $data->id));
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
