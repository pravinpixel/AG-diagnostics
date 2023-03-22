<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\ManageTest;
use Illuminate\Support\Facades\Http;
use App\Models\Admin\TimingDay;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;

class ManageTestController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.manage_test')||$user->hasAccess('user.add.manage_test'))
        {
        if($request->ajax()) {
            $data = ManageTest::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $delete = '';
                    $view = '';
                    // return button('edit',route('manage_test.edit', $data->id));
                    $view =  button('view',route('manage_test.view', $data->id));
                    if($user->hasAccess('user.delete.manage_test'))
                    $delete = button('delete',route('manage_test.delete', $data->id));
                    return $view.$delete;
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('manage_test.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_test.index');
    }
    else
    {
        Flash::error( __('action.permission'));
        return redirect()->route('admin.dashboard');
    }
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
    public function view($id)
    {
        $data = ManageTest::where('id',$id)->first();
        return view('admin.manage_test.view',compact('data'));
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
    public function syncRequest()
    {
        $key = 'agdpixel';
        $secret = 'p1x3l@agd';
        $responseTest = Http::withBasicAuth($key, $secret)
          ->get('https://agdmatrix.dyndns.org/a/Pixel/Tests');
        $responseTest = json_decode($responseTest);
          if (!is_null($responseTest)) {
            // ManageTest::truncate();
            foreach ($responseTest as $key => $val) {
              $data = [
                'primaryId' => $val->primaryId,
                'testName' => $val->testName,
                'testCode' => $val->testCode,
                'cityId' => $val->cityId,
                'cityName' => $val->cityName,
                'details' => $val->details,
                'sample' => $val->sample,
                'container' => $val->container,
                'qty' => $val->qty,
                'storage' => $val->storage,
                'method' => $val->method,
                'comments' => $val->comments,
                'fees' => $val->fees,
                'homeVisit' => $val->homeVisit,
                'discountFees' => $val->discountFees,
                'status' => 1,
              ];
              $res = ManageTest::updateOrCreate(['primaryId' => $val->primaryId,'cityId' => $val->cityId],$data);
            }
          }
          Flash::success( __('masters.sync_success'));
          return redirect()->back();
    }
}
