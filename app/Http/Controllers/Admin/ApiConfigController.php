<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiConfig;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;

class ApiConfigController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {
            
            $data = ApiConfig::all();
    
            return datatables()->of($data)
            ->addColumn('action', function($data){
                $action = button('edit',route('api_config.edit', $data->id)).button('delete',route('api_config.delete', $data->id)); 
                return $action;
            })
            ->rawColumns(array(
                'action'
            ))
            ->addIndexColumn()->make(true);
        }
        return view('admin.settings.api-config.index');
    }

    public function create()
    {
        return view('admin.settings.api-config.create');
    }

    public function updateOrCreate(Request $request , $id = null)
    {
  
        ApiConfig::updateOrCreate(["id" => $id], [
            'CorporateID'  =>  $request->CorporateID,
            'passCode'     =>  $request->passCode,
            'BaseUrl'      =>  $request->BaseUrl,
            'SiteId'       =>  $request->SiteId,
            'created_by'   =>  auth_id(),
        ]);

        Flash::success( __('action.saved', ['type' => 'Api Config']));

        return redirect()->route('api_config.index');
    }

    public function edit($id)
    {
        $apiConfig  = ApiConfig::findOrFail($id);
        return view('admin.settings.api-config.edit',compact('apiConfig'));
    }
    public function destroy($id)
    {
        $apiConfig  = ApiConfig::findOrFail($id);
        $apiConfig->delete();

        Flash::success( __('action.deleted', ['type' => 'Api Config']));

        return redirect()->route('api_config.index');
    }
}