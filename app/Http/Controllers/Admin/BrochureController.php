<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brochure;
use Yajra\DataTables\Facades\DataTables;
use Laracasts\Flash\Flash;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;


class BrochureController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.brochures')||$user->hasAccess('user.add.brochures'))
        {
        if($request->ajax())
        {
            $data = Brochure::select('*');
            return DataTables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action',function($data){
                $user = Sentinel::getUser();
                $edit = '';
                $delete = '';
                if($user->hasAccess('user.edit.brochures'))
                $edit = button('edit',route('brochures.edit',$data->id));

                if($user->hasAccess('user.delete.brochures'))
                $delete = button('delete',route('brochures.delete',$data->id));

                return $edit.$delete;
            })
            ->editColumn('type',function ($data){
                if($data->type)
                {
                    if($data->type == 'package_booklets')
                    {
                        $type = "Package Booklets";
                    }
                    if($data->type == 'technical_leaflets')
                    {
                        $type = "Technical Leaflets";
                    }
                }
                return $type;
                // return $data->user->firstname.' '.$orders->user->lastname;
            })
            ->addColumn('download',function($data){
                return '<a href="' .url('/'). '/upload/brochure/'.$data['brochure']. '" class="m-1 shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download>
                <i class="bi bi-download"></i>
                </a>';
            })
            ->addColumn('status',function($data){
                return toggleButton('status',route('brochures.status',$data->id),$data);
            })
            
            ->rawColumns(['status','action','download'])
            ->make(true);

        }
        return view('admin.master.brochures.index');
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
            else if($user->hasAccess('user.view.manage_city'))
            {
                return redirect()->route('city.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
            }
        }
    }
    public function create()
    {
        return view('admin.master.brochures.create');
    }
    public function store(Request $request,$id=null)
    {
        $this->validate($request, [
            'title' => 'required|unique:brochures,title,'. $id.',id,deleted_at,NULL',
            'brochure' => 'required|mimes:pdf,',
            'type' => 'required',
        ]);
       
            $data = new Brochure;
            $data->title = $request->title;
            $data->status = $request->status;
            $data->type  = $request->type ;
            if($request->brochure)
            {

                $filePath = 'upload/brochure';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                if($request->hasfile('brochure'))
                {

                        $file = $request->brochure;
                        
                        if($file->extension() == "pdf")
                        {


                        $name = $file->getClientOriginalName();

                        $file->move(public_path('upload/brochure'), $name);  
                        $attachPath= public_path('upload/brochure');
                        $attachement =  $attachPath.'/'.$name;
                        }
                }
            
                $data->brochure = $name;
            }
                $filePath = 'upload/brochure_image';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                
                if($request->hasfile('file'))
                {
                    $file = $request->file('file');
                        if($file->extension() ==  "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/brochure_image'), $name);  
                        
                        }
                        $data->image = $name;
                }
            $res =  $data->save();
        if($data->save())
        {
         Flash::success( __('action.saved', ['type' => 'Brochure']));
        }
        return redirect()->route('brochures.index');
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'title' => 'required|unique:brochures,title,'. $id.',id,deleted_at,NULL',
            // 'brochure_check' => 'required|mimes:pdf,',
            'type' => 'required',

        ]);
        $data = Brochure::where('id',$id)->first();
        $data->title = $request->title;
        $data->status = $request->status;
        $data->type  = $request->type ;


        if($request->brochure)
        {

            $filePath = 'upload/brochure';
            $path = public_path($filePath); 
            if(!file_exists($path))
            {
                mkdir($path, 0777, true);
            }
                
            if($request->hasfile('brochure'))
            {

                    $file = $request->brochure;
                    
                    if($file->extension() == "pdf")
                    {

                    $name = $file->getClientOriginalName();

                    $file->move(public_path('upload/brochure'), $name);  
                    $attachPath= public_path('upload/brochure');
                    $attachement =  $attachPath.'/'.$name;
                    }
                    
            }
            $data->brochure = $name;
        }
        $filePath = 'upload/brochure_image';
        $path = public_path($filePath); 
        if(!file_exists($path))
        {
            mkdir($path, 0777, true);
        }
            
        $files = [];
        
        if($request->hasfile('file'))
        {
            $file = $request->file('file');
                if($file->extension() ==  "png" || "jpg" || "jpeg")
                {
                $name = $file->getClientOriginalName();
                $file->move(public_path('upload/brochure_image'), $name);  
                
                }
                $data->image = $name;
        }

        $res =  $data->update();
        if($res)
        {
         Flash::success( __('action.saved', ['type' => 'Brochure']));
        }
        return redirect()->route('brochures.index');
    }
    public function edit($id)
    {

        $brochure = Brochure::find($id);
       
        return view('admin.master.brochures.edit',compact('brochure'));
    }
    public function brochureDelete($id)
    {
        $brochure = Brochure::find($id);
        $brochure->brochure = NULL;
        $data = $brochure->update();
        // dd($data);
        return redirect()->back();
        return view('admin.master.brochures.edit');
    }
    public function delete($id = null)
    {
        $department  = Brochure::find($id);
        $department->delete();
        Flash::success(__('action.deleted', ['type' => 'Brochure']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $data  = Brochure::find($request->id);
        if($request->val == 1)
        {
            $data->status = 0;
            $data->save();
        }
        else{
            $data->status = 1;
            $data->save();
        }
        Flash::success( __('action.status', ['type' => 'Brochure']));

    }
}
