<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\ManageTest;
use App\Models\Admin\TimingDay;
use Yajra\DataTables\Facades\DataTables;

class ManageTestController extends Controller
{
    public function index(Request $request)
    {
       
        if($request->ajax()) {
            $data = ManageTest::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    // return button('edit',route('manage_test.edit', $data->id));
                    return button('delete',route('manage_test.delete', $data->id));
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('manage_test.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_test.index');
    }
    public function create()
    {
        $category = Category::pluck('category','id');
        return view('admin.manage_test.create',compact('category'));
    }
    public function store(Request $request,$id = null)
    {
      
        $this->validate($request, [
            
            'testName' => 'required|unique:manage_tests,test,'. $id . ',id,deleted_at,NULL',
        ]);
        // dd($request->all());
       $city =  ManageTest::updateOrCreate(["id"=> $id],$request->all());
       Flash::success( __('action.saved', ['type' => 'Manage Test']));
       return redirect()->route('manage_test.index');
    }
    public function edit($id)
    {
        $test = ManageTest::find($id);
        $category = Category::pluck('category','id');
       
        return view('admin.manage_test.edit', compact('test','category'));
    }
    public function delete($id = null)
    {
        $state  = ManageTest::find($id);
        $state->delete();
        Flash::success( __('action.deleted', ['type' => 'Manage Test']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $state  = ManageTest::find($request->id);
        if($request->val == 1)
        {
            $state->status = 0;
            $state->save();
        }
        else{
            $state->status = 1;
            $state->save();
        }
        Flash::success( __('action.status', ['type' => 'Manage Test']));

    }
}
