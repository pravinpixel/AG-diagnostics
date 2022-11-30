<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\FeatureStories;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

use App\Models\Admin\TimingDay;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        $user = Sentinel::getUser();
        if($user->hasAccess('user.view.media_gallery')||$user->hasAccess('user.add.media_gallery'))
        {
        if($request->ajax()) {
            $data = FeatureStories::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {
                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.media_gallery'))
                    $edit=button('edit',route('feature.edit', $data->id));

                    if($user->hasAccess('user.delete.media_gallery'))
                    $delete = button('delete',route('feature.delete', $data->id));
                    return $edit.$delete;

                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('feature.edit', $data->id),$data);
                })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('admin.media.feature.index');
        }
        else
        {
            if($user->hasAccess('user.view.media_news_event'))
            {
                return redirect()->route('events.index');
            }
            else{
                Flash::error( __('action.permission'));
                return redirect()->route('admin.dashboard');
                // return redirect()->back();
            }

        }
    }
    public function create(Type $var = null)
    {
        return view('admin.media.feature.create');
    }
    public function store(Request $request,$id = null)
    {
        
        $this->validate($request, [
            
            'story_title' => 'required|unique:feature_stories,story_title,'. $id.',id,deleted_at,NULL',
            "story_url" => "nullable|url",
            'file' => 'mimes:jpeg,png,jpg',
           
        ],
        $messages = [
            
            "file.*.mimes" => "File type not allowed. Upload only PDF files.",
        ]);
        
        if($id)
        {

            $data = FeatureStories::where('id',$id)->first();
            $data->story_title = $request->story_title;
            $data->date = $request->date;
            $data->story_url = $request->story_url;
            $data->description = $request->description;
            $data->video_link = $request->video_link;
            $data->status = $request->status;
                    // $filePath = 'upload/media/feature/pdf_upload';
                    // $path = public_path($filePath); 
                    // if(!file_exists($path))
                    // {
                    //     mkdir($path, 0777, true);
                    // }
                    // $files = [];
                    // if($request->hasfile('file'))
                    // {
                    //     foreach($request->file('file') as $file)
                    //     {
                    //         if($file->extension() == "pdf")
                    //         {
                    //         $name = $file->getClientOriginalName();
                    //         $file->move(public_path('upload/media/feature/pdf_upload'), $name);  
                    //         $files[] = $name; 
                    //         }
                    //     }
                        
                    // }
                    $filePath = 'upload/media/feature/image';
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
                            $file->move(public_path('upload/media/feature/image'), $name);  
                            
                            }
                            $data->pdf = $name;
                    }

            $data->status = $request->status;
            
            $data->update();
           
        }
        else{

            $data = new FeatureStories;
            $data->story_title = $request->story_title;
            $data->date = $request->date;
            $data->story_url = $request->story_url;
            $data->description = $request->description;
            $data->video_link = $request->video_link;
            $data->status = $request->status;

                    // $filePath = 'upload/media/feature/pdf_upload';
                    // $path = public_path($filePath); 
                    // if(!file_exists($path))
                    // {
                    //     mkdir($path, 0777, true);
                    // }
                    // $files = [];
                    // if($request->hasfile('file'))
                    // {
                    //     foreach($request->file('file') as $file)
                    //     {
                           
                    //         if($file->extension() == "pdf")
                    //         {
                    //             // dd("s");
                    //         // print_r("if"." ".$file->getClientOriginalName()." ");
                    //         $name = $file->getClientOriginalName();
                    //         $file->move(public_path('upload/media/feature/pdf_upload'), $name);  
                    //         $files[] = $name; 
                    //         }
                    //     }
                    // }
                    $filePath = 'upload/media/feature/image';
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
                            $file->move(public_path('upload/media/feature/image'), $name);  
                            
                            }
                    }
                //    dd($name);
            $data->status = $request->status;
            $data->pdf = $name;
            $data->save();

        }
       Flash::success( __('action.saved', ['type' => 'Feature Stories']));
       return redirect()->route('feature.index');
    }
    public function edit($id)
    {
        $feature = FeatureStories::find($id);
       
        return view('admin.media.feature.edit', compact('feature'));
    }
    public function delete($id = null)
    {
        $state  = FeatureStories::find($id);
        $state->delete();
        Flash::success( __('action.deleted', ['type' => 'Feature Stories']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        // dd($request->all());
        $state  = FeatureStories::find($request->id);
        if($request->val == 1)
        {
            $state->status = 0;
            $state->save();
        }
        else{
            $state->status = 1;
            $state->save();
        }
        Flash::success( __('action.status', ['type' => 'Feature Stories']));

    }
    public function deletePdf(Request $request)
    {
        $data = FeatureStories::where('id',$request->productId)->first();
      
        $dataPdf = json_decode($data['pdf']);
      
        $val = $request->pdfKey;
        
        $rr = array_splice($dataPdf,$val,1);
        $data['pdf'] = $dataPdf;
        $data->save();
        return  $data['pdf'];
    }
}
