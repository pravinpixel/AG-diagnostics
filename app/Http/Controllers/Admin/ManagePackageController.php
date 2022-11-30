<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\ManagePackage;
use App\Models\Admin\Organ;
use App\Models\Admin\City;
use App\Models\Admin\Speciality;
use App\Models\Admin\Condition;
use App\Models\Admin\ManageTest;
use App\Models\Admin\TimingDay;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Carbon;
class ManagePackageController extends Controller
{
    public function index(Request $request)
    {

        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.manage_package'))
        {
        if($request->ajax()) {
            $data = ManagePackage::with(['condition','specialty','organ'])->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    $view =  button('view',route('manage_package.view', $data->id));
                    if($user->hasAccess('user.edit.manage_package'))
                    $edit =  button('edit',route('manage_package.edit', $data->id));

                    if($user->hasAccess('user.delete.manage_package'))
                    $delete = button('delete',route('manage_package.delete', $data->id));
                    return $view.$edit.$delete;

                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('manage_package.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_package.index');
        }
        else
        {
            Flash::error( __('action.permission'));
            return redirect()->route('admin.dashboard');
        }
    }
    public function view($id)
    {
        $data = ManagePackage::where('id',$id)->first();
        return view('admin.manage_package.view',compact('data'));
    }
    public function create()
    {
       $country =ManagePackage::get()->pluck('country', 'id');
       $specialty = Speciality::get()->pluck('speciality', 'id');
       $organ =Organ::get()->pluck('organs', 'id');
       $condition =Condition::get()->pluck('condition', 'id');
       $test_include =ManageTest::select('testName','id')->get(); //->paginate(7)
       $city =City::where('status',1)->get();
        // return view('admin.manage_package.create',compact('specialty','organ','condition','test_include'));
        return view('admin.manage_package.create',compact('specialty','organ','condition','test_include','city'));
    }
    public function store(Request $request,$id = null)
    {
        if($id)
        {
            $data = ManagePackage::where('id',$id)->first();

            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;
            $data->is_selected = $request->is_selected;
            $data->status = $request->status;
            if($request->is_selected)
            {
                $data->is_selected = 1;
            }
            else{
                $data->is_selected = 0;
            }
            $data->update();
           
        }
        else{
        
            $data = new ManagePackage;
          
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;
            $data->status = $request->status;
            $data->save();

        }
    //    $data =  ManagePackage::updateOrCreate(["id"=> $id],$request->all());
       Flash::success( __('action.saved', ['type' => 'Manage Package']));
       return redirect()->route('manage_package.index');
    }
    public function edit($id)
    {
        $manage_package = ManagePackage::find($id);
        $specialty = Speciality::get()->pluck('speciality', 'id');
        $organ =Organ::get()->pluck('organs', 'id');
        $condition =Condition::get()->pluck('condition', 'id');
        $test_include =ManageTest::get();
        $city =City::where('status',1)->get();
        return view('admin.manage_package.edit',compact('manage_package','specialty','organ','condition','test_include','city'));
    }
    public function delete($id = null)
    {
        $city  = ManagePackage::find($id);
        $city->delete();
        Flash::success( __('action.deleted', ['type' => 'Manage Package']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $city  = ManagePackage::find($request->id);
        if($request->val == 1)
        {
            $city->status = 0;
            $city->save();
        }
        else{
            $city->status = 1;
            $city->save();
        }
        Flash::success( __('action.status', ['type' => 'Manage Package']));

    }
}
