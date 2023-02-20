<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.banner')||$user->hasAccess('user.add.banner'))
        {
        if($request->ajax()) {

            $data = Banners::select([
                'id',
                'Title',
                'Content',
                'Url',
                'DesktopImage',
                'MobileImage',
                'OrderBy',
                'Status'
            ]);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('Mobile_Image', function ($data) {
                    return '
                        <img src="'.asset($data->MobileImage).'" height="40"/>
                    ';
                }) 
                ->addColumn('Desktop_Image', function ($data) {
                    return '
                        <img src="'.asset($data->DesktopImage).'" height="40"/>
                    ';
                })                
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.banner'))
                    $edit = button('edit',route('banner.edit', $data->id));

                    if($user->hasAccess('user.delete.banner'))
                    $delete = button('delete',route('banner.delete', $data->id));

                    return $edit.$delete;
                })
            ->rawColumns(['action','Mobile_Image','Desktop_Image'])
            ->make(true);
        }
        return view('admin.master.banner.index');
        }
        else
        {
            // Flash::error( __('action.permission'));
            if($user->hasAccess('user.view.manage_country'))
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
        return view('admin.master.banner.create');
    }

    public function edit($id)
    {
        $banner = Banners::find($id);
        return view('admin.master.banner.edit', compact('banner'));
    }

    public function store(Request $request, $id = null)
    { 
        $this->validate($request, [
            'Title' => 'required|unique:banners,Title,'. $id.',id,deleted_at,NULL',
           
        ]);
        $banner =  Banners::updateOrCreate(["id"=> $id],$request->except(['_token','MobileImage','DesktopImage']));
        if($banner) {
            if($request->has('MobileImage')) {
                // if(Storage::exists($banner->MobileImage)){
                //     Storage::delete($banner->MobileImage);
                // } 
                // $MobileImage               =  $request->file('MobileImage')->store('public/files/mobile_images');
                // $MobileImage               =  $request->file('MobileImage')->public_path('public/files/mobile_images');
                
                $filePath = 'upload/files/mobile_images';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                
                $file = $request->MobileImage;
                if($file->extension() == "png" || "jpg" || "jpeg" || "webp")
                {
                $name = $file->getClientOriginalName();
            

                $file->move(public_path('upload/files/mobile_images'), $name);
                // $attachPath= public_path('upload/files/mobile_images');

                $MobileImage =  $filePath.'/'.$name;
                }
                $banner  ->  MobileImage   =  $MobileImage;
                $banner  ->  save();
            }

            if($request->has('DesktopImage')) {
                // if(Storage::exists($banner->DesktopImage)){
                //     Storage::delete($banner->DesktopImage);
                // }
                // $DesktopImage               =   $request->file('DesktopImage')->store('public/files/desktop_images');
                // $DesktopImage               =   $request->file('DesktopImage')->public_path('public/files/desktop_images');
                $filePath = 'upload/files/desktop_images';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                
                $file = $request->DesktopImage;
                if($file->extension() == "png" || "jpg" || "jpeg" || "webp")
                {
                $name = $file->getClientOriginalName();
            

                $file->move(public_path('upload/files/desktop_images'), $name);
                // $attachPath= public_path('upload/files/desktop_images');

                $DesktopImage =  $filePath.'/'.$name;
                }
                $banner  -> DesktopImage   =   $DesktopImage;
                $banner  ->  save();
            }
        }
        
        Flash::success( __('action.saved', ['type' => 'Banner']));
        return redirect()->route('banner.index');
    }

    public function delete($id = null)
    {
        $banner  = Banners::find($id);
        if(Storage::exists($banner->MobileImage)){
            Storage::delete($banner->MobileImage);
        }
        if(Storage::exists($banner->DesktopImage)){
            Storage::delete($banner->DesktopImage);
        }
        $banner->delete();
        Flash::success( __('action.deleted', ['type' => 'Banner']));
        return redirect()->back();
    }
}