<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Admin\State;
use App\Models\Admin\Country;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
           
            $data = State::with('country')->select('*');

            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.manage_state'))
                    $edit=button('edit',route('state.edit', $data->id));

                    if($user->hasAccess('user.delete.manage_state'))
                    $delete = button('delete',route('state.delete', $data->id));

                    return $edit.$delete;

                })
                // ->addColumn('country', function ($data) {
                //     return $data->country->country;
                // })
                ->addColumn('status', function($data) {
                   
                   return toggleButton('status',route('state.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.master.state.index');
    }
    public function create(Type $var = null)
    {
       $country =Country::get()->pluck('country', 'id');
        return view('admin.master.state.create',compact('country'));
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'state' => 'required|unique:states,state,'. $id.',id,deleted_at,NULL',
        ]);
        // dd($request->input('status'));
       $state =  State::updateOrCreate(["id"=> $id],$request->all());
       
       Flash::success( __('action.saved', ['type' => 'State']));
       return redirect()->route('state.index');
    }
    public function edit($id)
    {
        $state = State::find($id);
        $country =Country::get()->pluck('country', 'id');
        return view('admin.master.state.edit', compact('state','country'));
    }
    public function delete($id = null)
    {
        $state  = State::find($id);
        $state->delete();
        Flash::success( __('action.deleted', ['type' => 'State']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        // dd($request->all());
        $state  = State::find($request->id);
        if($request->val == 1)
        {
            $state->status = 0;
            $state->save();
        }
        else{
            $state->status = 1;
            $state->save();
        }
        Flash::success( __('action.status', ['type' => 'State']));

    }
}
