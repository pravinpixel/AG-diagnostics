<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\Testimonial;
use App\Models\Admin\TimingDay;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Yajra\DataTables\Facades\DataTables;
class TestimonialController extends Controller
{
    public function index(Request $request)
    {
       
        if($request->ajax()) {
            $data = Testimonial::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.manage_testimonial'))
                    $edit=button('edit',route('testimonial.edit', $data->id));

                    if($user->hasAccess('user.delete.manage_testimonial'))
                    $delete = button('delete',route('testimonial.delete', $data->id));
                    return $edit.$delete;

                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('testimonial.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.testimonial.index');
    }
    public function create()
    {
        return view('admin.testimonial.create');
    }
    public function store(Request $request,$id = null)
    {
        $this->validate($request, [
            
            'title' => 'required|unique:testimonials,title,'. $id.',id,deleted_at,NULL',
            "video_url" => 'nullable|url',
            'file' => 'mimes:jpeg,png,jpg',
        ]);
       if($id)
       {
           $data = Testimonial::where('id',$id)->first();
           $data->title = $request->title;
           $data->date = $request->date;
           $data->type = $request->type;
           $data->given_by = $request->given_by;
           
           if($request->type == 1)
           {
                  
               $data->description = $request->description;
               $data->video_url = '';
               
           }
           if($request->type == 2)
           {

               $data->description = '';
               $data->video_url = $request->video_url;
           }
            if($request->file)
            {
                $filePath = 'upload/testimonial/photo';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                if($request->hasfile('file'))
                {
                        $file = $request->file('file');
                        
                        if($file->extension() == "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/testimonial/photo'), $name);  
                        $files = $name; 
                        
                        }
                }
                $data->photo = $files;
            }
            if($request->video_cover_image)
            {
                $filePath = 'upload/testimonial/video_cover_image';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                if($request->hasfile('video_cover_image'))
                {
                        $file = $request->file('video_cover_image');
                        
                        if($file->extension() == "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/testimonial/video_cover_image'), $name);  
                        $files = $name; 
                        
                        }
                }
                $data->video_cover_image = $files;
            }
            // else{
            //     $data->video_cover_image = "cover_image.png";
            // }
           $data->designation = $request->designation;
           $data->status = $request->status;
           $data->update();
          
       }
       else{
            $data = new Testimonial;
            $data->title = $request->title;
            $data->date = $request->date;
            $data->type = $request->type;
            $data->given_by = $request->given_by;
            
            if($request->type == 1)
            {
                $data->description = $request->description;
                $data->video_url = '';
                
            }
            if($request->type == 2)
            {

                $data->description = '';
                $data->video_url = $request->video_url;
            }
            if($request->file)
            {
                $filePath = 'upload/testimonial/photo';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                if($request->hasfile('file'))
                {
                        $file = $request->file('file');
                        
                        if($file->extension() == "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/testimonial/photo'), $name);  
                        $files = $name; 
                        
                        }
                }
                // dd($files);
                $data->photo = $files;
            }
            // else{
            //     $data->photo = "dummy.jpeg";
            // }

            if($request->video_cover_image)
            {
                $filePath = 'upload/testimonial/video_cover_image';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                if($request->hasfile('video_cover_image'))
                {
                        $file = $request->file('video_cover_image');
                        
                        if($file->extension() == "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/testimonial/video_cover_image'), $name);  
                        $files = $name; 
                        
                        }
                }
                $data->video_cover_image = $files;
            }
            else{
                $data->video_cover_image = "cover_image.png";
            }
            $data->designation = $request->designation;
            $data->status = $request->status;
            $data->save();

       }
       Flash::success( __('action.saved', ['type' => 'Testimonial']));
       return redirect()->route('testimonial.index');

    }
    public function edit($id)
    {
        $test = Testimonial::find($id);
       
        return view('admin.testimonial.edit', compact('test'));
    }
    public function delete($id = null)
    {
        $state  = Testimonial::find($id);
        $state->delete();
        Flash::success( __('action.deleted', ['type' => 'Manage Test']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $state  = Testimonial::find($request->id);
        if($request->val == 1)
        {
            $state->status = 0;
            $state->save();
        }
        else{
            $state->status = 1;
            $state->save();
        }
        Flash::success( __('action.status', ['type' => 'Manage Test']));

    }
}
