<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.manage_city'))
        {
        if($request->ajax()) {
            $data = City::with('country')->with('state')->select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {

                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    // if($user->hasAccess('user.edit.manage_city'))
                    // $edit = button('edit',route('city.edit', $data->id));

                    if($user->hasAccess('user.delete.manage_city'))
                    $delete = button('delete',route('city.delete', $data->id));

                    return $delete;

                })
                // ->addColumn('country', function ($data) {
                //     return $data->country->country;
                // })
                ->addColumn('status', function($data) {
                   
                   return toggleButton('status',route('city.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.master.city.index');
        }
        else
        {
            // Flash::error( __('action.permission'));
            if($user->hasAccess('user.view.banner')||$user->hasAccess('user.add.banner')){
                return redirect()->route('banner.index');
            }
            else if($user->hasAccess('user.view.manage_country'))
            {
                return redirect()->route('country.index');
            }
            else if($user->hasAccess('user.view.manage_state'))
            {
                return redirect()->route('state.index');
            }
            else if($user->hasAccess('user.view.brochures')||$user->hasAccess('user.add.brochures'))
            {
                return redirect()->route('brochures.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function create()
    {
       $country =Country::get()->pluck('country', 'id');
       $state =State::get()->pluck('state', 'id');
        return view('admin.master.city.create',compact('country','state'));
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'city' => 'required|unique:cities,city,'. $id.',id,deleted_at,NULL',
        ]);
       $city =  City::updateOrCreate(["id"=> $id],$request->all());
       Flash::success( __('action.saved', ['type' => 'City']));
       return redirect()->route('city.index');
    }
    public function edit($id)
    {
        $city = City::find($id);
        $country =Country::get()->pluck('country', 'id');
        $state = State::get()->pluck('state', 'stateId');
        return view('admin.master.city.edit', compact('city','state','country'));
    }
    public function delete($id = null)
    {
        $city  = City::find($id);
        // $city->forceDelete();
        $city->delete(); 
        Flash::success( __('action.deleted', ['type' => 'City']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $city  = City::find($request->id);
        if($request->val == 1)
        {
            $city->status = 0;
            $city->save();
        }
        else{
            $city->status = 1;
            $city->save();
        }
        Flash::success( __('action.status', ['type' => 'City']));

    }
}
