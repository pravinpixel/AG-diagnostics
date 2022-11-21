<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\Area;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;


class AreaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Area::with('country')->with('state')->with('city')->orderBy('id', 'DESC');

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if ($user->hasAccess('user.edit.manage_area'))
                        $edit = button('edit', route('area.edit', $data->id));

                    if ($user->hasAccess('user.delete.manage_area'))
                        $delete = button('delete', route('area.delete', $data->id));

                    return $edit . $delete;
                })
                // ->addColumn('country', function ($data) {
                //     return $data->country->country;
                // })
                ->addColumn('status', function ($data) {

                    return toggleButton('status', route('area.edit', $data->id), $data);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.master.area.index');
    }
    public function create(Type $var = null)
    {
        $country = Country::get()->pluck('country', 'id');
        $city = City::get()->pluck('city', 'id');
        $state = State::get()->pluck('state', 'id');
        return view('admin.master.area.create', compact('country', 'state', 'city'));
    }
    public function store(Request $request, $id = null)
    {
        $this->validate($request, [

            'area' => 'required|unique:areas,area,' . $id . ',id,deleted_at,NULL',
        ]);
        $area =  Area::updateOrCreate(["id" => $id], $request->all());

        Flash::success(__('action.saved', ['type' => 'Area']));
        return redirect()->route('area.index');
    }
    public function edit($id)
    {
        $area = Area::find($id);
        $country = Country::get()->pluck('country', 'id');
        $city = City::get()->pluck('city', 'id');
        $state = State::get()->pluck('state', 'id');
        return view('admin.master.area.edit', compact('city', 'state', 'country', 'area'));
    }
    public function delete($id = null)
    {
        $area  = Area::find($id);
        $area->delete();
        Flash::success(__('action.deleted', ['type' => 'Area']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        // dd($request->all());
        $area  = Area::find($request->id);
        if ($request->val == 1) {
            $area->status = 0;
            $area->save();
        } else {
            $area->status = 1;
            $area->save();
        }
        Flash::success(__('action.status', ['type' => 'State']));
    }
}
