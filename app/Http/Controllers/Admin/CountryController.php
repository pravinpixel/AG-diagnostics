<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Country;
use Laracasts\Flash\Flash;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.manage_country'))
        {
            if($request->ajax()) {
            
                $data = Country::select([
                    'id',
                    'country',
                    'country_code',
                    'iso_code_two',
                    'iso_code_three',
                    'status',
                ])->select('*');

                return DataTables::eloquent($data)
                    ->addIndexColumn()              
                    ->addColumn('action', function ($data) {

                        $user = Sentinel::getUser();
                        $edit = '';
                        $delete = '';
                        // if($user->hasAccess('user.edit.manage_country'))
                        // $edit=button('edit',route('country.edit', $data->id));

                        if($user->hasAccess('user.delete.manage_country'))
                        $delete = button('delete',route('country.delete', $data->id));

                        return $delete;

                    })
                    // <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger"
                    //  data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}>
                    // ->addColumn('status', function ($data) {
                    //     return button('status',route('country.status', $data->id));
                    //   })
                    ->addColumn('status', function($data) {
                    
                    return toggleButton('status',route('country.edit', $data->id),$data);
                    })
                ->rawColumns(['action','status'])
                ->make(true);
            }
            return view('admin.master.country.index');
        }
        else
        {
            // Flash::error( __('action.permission'));
            if($user->hasAccess('user.view.banner')||$user->hasAccess('user.add.banner'))
            {
                return redirect()->route('banner.index');
            }
            else if($user->hasAccess('user.view.manage_state'))
            {
                return redirect()->route('state.index');
            }
            else if($user->hasAccess('user.view.manage_city'))
            {
                return redirect()->route('city.index');
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
    public function create(Type $var = null)
    {
       
        return view('admin.master.country.create');
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'country' => 'required|unique:countries,country,'. $id . ',id,deleted_at,NULL',
        ]);
       $banner =  Country::updateOrCreate(["id"=> $id],$request->all());
       
       Flash::success( __('action.saved', ['type' => 'Country']));
       return redirect()->route('country.index');
    }
    public function edit($id)
    {
        $country = Country::find($id);
        return view('admin.master.country.edit', compact('country'));
    }
    public function delete($id = null)
    {
        try {
            $country  = Country::find($id)->forceDelete();
            Flash::success( __('action.deleted', ['type' => 'Country']));
            return redirect()->back();
        } catch(\Exception $exception){
            // $errormsg = 'This data is' . $exception->getCode();
            Flash::success( __('action.existsMessage'));
            return redirect()->back();
        }
        // $country->delete();
    }
    public function status(Request $request)
    {
        $country  = Country::find($request->id);
        if($request->val == 1)
        {
            $country->status = 0;
            $country->save();
        }
        else{
            $country->status = 1;
            $country->save();
        }
        Flash::success( __('action.status', ['type' => 'Country']));

    }
}
