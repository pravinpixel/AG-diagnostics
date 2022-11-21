<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Models\Admin\CountryTelephoneCode;
use App\Models\Admin\State;
use App\Models\Admin\Area;
use App\Models\Admin\ManageLab;
use App\Models\Admin\TimingDay;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class ManageLabController extends Controller
{
    public function index(Request $request)
    {
       
        if($request->ajax()) {
            $data = ManageLab::with('country','area','state','city')->orderBy('id', 'DESC');
            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.manage_lab'))
                    $edit=button('edit',route('manage.edit', $data->id));

                    if($user->hasAccess('user.delete.manage_lab'))
                    $delete = button('delete',route('manage.delete', $data->id));

                    return $edit.$delete;

                })
                // ->addColumn('country', function ($data) {
                //     return $data->country->country;
                // })
                ->addColumn('status', function($data) {
                   
                   return toggleButton('status',route('manage.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.manage_lab.index');
    }
    public function create()
    {
       $country =Country::where('status',1)->get()->pluck('country', 'id','country_code');
       $state =State::where('status',1)->get()->pluck('state', 'id','state_code');
       $city =City::where('status',1)->get()->pluck('city', 'id');
       $area =Area::where('status',1)->get()->pluck('area', 'id');
       $timingDay =TimingDay::select('days','id')->get();
      
        return view('admin.manage_lab.create',compact('country','state','area','city','timingDay'));
    }
   
    // public function get_country(Request $request)
    // {
    //     $country_code = State::where('country_id',$request->id)->select('id','state_code')->first();
    //   return response()->json(['data' => $country_code]);
    // }
    public function get_state(Request $request)
    {
        
        
        $state = State::where('country_id',$request->id)->select('state','stateId')->get();
        $countryCode = Country::where('id',$request->id)->select('id','country_code')->first();
        return response()->json(['data' => $state,'countryCode'=>$countryCode]);
    }
    public function get_city(Request $request)
    {
        // dd("sss");
        $city = City::where('stateId',$request->id)->select('city','cityId')->get();
        $stateCode = State::where('stateId',$request->id)->select('stateId','state_code')->first();
        return response()->json(['data' => $city,'stateCode'=>$stateCode]);
    }
    public function get_area(Request $request)
    {
        $area = Area::where('city_id',$request->id)->select('area','id')->get();
        return response()->json(['data' => $area]);
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validate($request, [
            
        //     'lab_name' => 'required|unique:manage_labs,lab_name,',
        // ]);
        $data = new ManageLab;
        $data->lab_name = $request->lab_name;
        $data->address = $request->address;
        $data->country_id = $request->country_id;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->location_map_url = $request->location_map_url;
        $data->location_map = $request->location_map;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->near_by = $request->near_by;

        $timing = implode(',',$request->timing); //array to string
        $timing_day = implode(',',$request->timing_day); //array to string

        $data->timing = $timing;
        $data->timing_day = $timing_day;

        $time_landline_number = implode(',',$request->time_landline_number);
        $data->landline = $time_landline_number;

        $time_mobile = implode(',',$request->time_mobile);
        $data->mobile = $time_mobile;
        $data->facilities = $request->facilities;

        $data->toll_free_number = $request->toll_free_number;
        $data->contact_person = $request->contact_person;
        $data->email = $request->email;

       
        $data->specialty = $request->specialty;
        $data->department = $request->department;
        $data->meta_title = $request->meta_title;
        $data->meta_keyword = $request->meta_keyword;
        $data->meta_description = $request->meta_description;
        $data->status = $request->status;
       if($data->save())
       {
        Flash::success( __('action.saved', ['type' => 'Manage Lab']));
       }
     
       return redirect()->route('manage.index');
    }
    public function update(Request $request,$id)
    {
   
    //    $this->validate($request, [
            
    //     'lab_name' => 'required|unique:manage_labs,lab_name,'.$id,
    // ]);  
    $data = ManageLab::where('id',$request->id)->first();
    $data->lab_name = $request->lab_name;
    $data->address = $request->address;
    $data->country_id = $request->country_id;
    $data->state_id = $request->state_id;
    $data->city_id = $request->city_id;
    $data->area_id = $request->area_id;
    $data->location_map_url = $request->location_map_url;
    $data->location_map = $request->location_map;
    $data->latitude = $request->latitude;
    $data->longitude = $request->longitude;
    $data->near_by = $request->near_by;

    $timing = implode(',',$request->timing); //array to string
    $timing_day = implode(',',$request->timing_day); //array to string
    // dd($timing);
    $data->timing = $timing;
    $data->timing_day = $timing_day;

    $time_landline_number = implode(',',$request->time_landline_number);
    $data->landline = $time_landline_number;

    $time_mobile = implode(',',$request->time_mobile);
    $data->mobile = $time_mobile;

    // $data->landline = $request->toll_free_number;
    // $data->mobile = $request->timing;

    $data->facilities = $request->facilities;

    $data->toll_free_number = $request->toll_free_number;
    $data->contact_person = $request->contact_person;
    $data->email = $request->email;

   
    $data->specialty = $request->specialty;
    $data->department = $request->department;
    $data->meta_title = $request->meta_title;
    $data->meta_keyword = $request->meta_keyword;
    $data->meta_description = $request->meta_description;
    $data->status = $request->status;
    if($data->update())
    {
     Flash::success( __('action.saved', ['type' => 'Manage Lab']));
    }
    return redirect()->route('manage.index');
       
    }

    public function edit($id)
    {
       
        $manageLab = ManageLab::find($id);

        $stateCode = State::where('id',$manageLab['state_id'])->select('state_code')->first();
       
        $countryCode = Country::where('id',$manageLab['country_id'])->select('country_code')->first();
        $country =Country::where('status',1)->select('country','id')->get();
      
        $state =State::where('status',1)->select('state', 'id')->get();
        
        $city =City::where('status',1)->select('city', 'id')->get();
        $area =Area::where('status',1)->select('area', 'id')->get();

        $timingDay =TimingDay::select('days','id')->get();
        // $state = State::get()->pluck('state', 'id');
        // $manageLabCount = count($manageLab['timing_day']);
        $manageLabCount = explode(',',$manageLab['timing_day']);
        $manageLabCount = count($manageLabCount);
        $landlineCount =  explode(',',$manageLab['landline']);
        $landlineCount = count($landlineCount);
        return view('admin.manage_lab.edit', compact('manageLab','country','state','city','area','timingDay','manageLabCount','landlineCount','stateCode','countryCode'));
    }

    public function delete($id = null)
    {
        $city  = ManageLab::find($id);
        $city->delete();
        Flash::success( __('action.deleted', ['type' => 'Manage Lab']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $city  = ManageLab::find($request->id);
        if($request->val == 1)
        {
            $city->status = 0;
            $city->save();
        }
        else{
            $city->status = 1;
            $city->save();
        }
        Flash::success( __('action.status', ['type' => 'Manage Lab']));

    }
}
