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
use Illuminate\Support\Facades\File;
use App\Models\Admin\TimingDay;
use Illuminate\Support\Str;
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
            $data = ManagePackage::select('*');
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
             
                ->editColumn('sorting_order', function($data) {
                    if($data->sorting_order)
                    {
                       return  $data->sorting_order = $data->sorting_order;
                    }
                    else
                    {
                        return $data->sorting_order = '';
                    }
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
        return view('admin.manage_package.create',compact('specialty','organ','condition','test_include','city'));
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            'sorting_order' => 'nullable|unique:manage_packages,sorting_order,'.$id.',id,deleted_at,NULL',
        ]);
        if($id)
        {
            $data = ManagePackage::where('id',$id)->first();

            if($request->icon)
            {
                $filePath = 'upload/packages/'.$request->primaryId;
                $path = public_path($filePath);
                if(!file_exists($path)){
                    mkdir($path,0777,true);
                }
                if($request->hasfile('icon')){
                    \File::deleteDirectory($filePath );
                    $file = $request->icon;
                    if($file->extension() == ('png'||'jpg'||'jpeg'))
                    {
                        $name = $file->getClientOriginalName();
                        $name = str_replace(" ","_",$name);

                        $file->move(public_path($filePath), $name);  
                        $attachPath= public_path($filePath);
                       
                        $attachement =  $filePath.'/'.$name;
                    }   
                }
                $data->icon = $attachement;
            }
         
            $data->sorting_order = $request->sorting_order;
            $data->discountFees = $request->discountFees;
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
            if($request->icon)
            {
                $filePath = 'upload/packages/'.$request->primaryId;
                $path = public_path($filePath);
                if(!file_exists($path)){
                    mkdir($path,0777,true);
                }
                if($request->hasfile('icon')){
                    \File::deleteDirectory($filePath );
                    $file = $request->icon;
                    if($file->extension() == ('png'||'jpg'||'jpeg'))
                    {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path($filePath), $name);  
                        $attachPath= public_path($filePath);
                        $attachement =  $filePath.'/'.$name;
                    }   
                }
                $data->icon = $name;
            }
            $data->sorting_order = $request->sorting_order;
            $data->discountFees = $request->discountFees;
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
    public function imageDelete($id = null)
    {
        $package = ManagePackage::find($id);
        $package->icon = NULL;
        $data = $package->update();
        return redirect()->back();
    }
    public function syncRequest()
    {
        $key = 'agdpixel';
        $secret = 'p1x3l@agd';
        $responsePackages = Http::withBasicAuth($key, $secret)
          ->get('https://agdmatrix.dyndns.org/a/Pixel/Packages');
        $responsePackages = json_decode($responsePackages);
        if (!is_null($responsePackages)) {
          // ManagePackage::truncate();
          foreach ($responsePackages as $key => $val) {
            $data = [
              'primaryId' => $val->primaryId,
              'packageName' => $val->packageName,
              'slug' => Str::slug($val->packageName),
              'packageCode' => $val->packageCode,
              'cityId' => $val->cityId,
              'cityName' => $val->cityName,
              'testLists' => $val->testLists,
              'testSchedule' => $val->testSchedule,
              'sampleType' => $val->sampleType,
              'ageRestrictions' => $val->ageRestrictions,
              'preRequisties' => $val->preRequisties,
              'reportAvailability' => $val->reportAvailability,
              'comments' => $val->comments,
              'fees' => $val->fees,
              'homeVisit' => $val->homeVisit,
              'discountFees' => $val->discountFees,
              'status' => 1,
            ];
            $res = ManagePackage::updateOrCreate(['primaryId' => $val->primaryId,'cityId' => $val->cityId],$data);
          }
        }
        Flash::success( __('masters.sync_success'));
        return redirect()->back();
    }
}
