<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use App\Models\Admin\NewsEvents;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use App\Models\Admin\NewsEventImage;

use App\Models\Admin\TimingDay;
use Yajra\DataTables\Facades\DataTables;

class NewsEventsController extends Controller
{
    public function index(Request $request)
    {
    
        if($request->ajax()) {
            $data = NewsEvents::select('*');
            return DataTables::eloquent($data)
                ->addIndexColumn()              
                ->addColumn('action', function ($data) {

                    $user = Sentinel::getUser();
                    $edit = '';
                    $delete = '';
                    if($user->hasAccess('user.edit.media_news_event'))
                    $edit=button('edit',route('events.edit', $data->id));

                    if($user->hasAccess('user.delete.media_news_event'))
                    $delete = button('delete',route('events.delete', $data->id));
                    return $edit.$delete;
                })
                ->addColumn('status', function($data) {
                   return toggleButton('status',route('events.edit', $data->id),$data);
                })
                ->addColumn('multipleImage', function($data) {
                    return button('multipleImage',route('events.multipleImage', $data->id),$data);
                 })
            ->rawColumns(['action','status','multipleImage'])
            ->make(true);
        }
        return view('admin.media.news_events.index');
    }
    public function create(Type $var = null)
    {
        return view('admin.media.news_events.create');
    }
    public function store(Request $request,$id = null)
    {
        // dd($request->all());
        $this->validate($request, [
            
            'event_name' => 'required|unique:news_events,event_name,'. $id.',id,deleted_at,NULL',
            "video_url" => 'nullable|url',
            "news_url" => "nullable|url",
            'file'   => 'mimes:jpeg,png,jpg',
           
        ],
        $messages = [
            
            "file.*.mimes" => "File type not allowed. Upload only PDF files.",
        ]);
        if($id)
        {

            $data = NewsEvents::where('id',$id)->first();
            $data->event_name = $request->event_name;
            $data->type = $request->type;
            $data->start = $request->start;
            $data->description = $request->description;
            $data->choose = $request->choose;

            if($request->file)
                {
                    $filePath = 'upload/media/news_events/photo';
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
                            $file->move(public_path('upload/media/news_events/photo'), $name);  
                            $files = $name; 
                            
                            }
                    }
                    $data->photo = $files;
                }
            if($request->mobile_image)
            {
                $filePath = 'upload/media/news_events/mobile_image';
                $path = public_path($filePath); 
                if(!file_exists($path))
                {
                    mkdir($path, 0777, true);
                }
                    
                $files = [];
                if($request->hasfile('mobile_image'))
                {
                        $file = $request->file('mobile_image');
                        
                        if($file->extension() == "png" || "jpg" || "jpeg")
                        {
                        $name = $file->getClientOriginalName();
                        $file->move(public_path('upload/media/news_events/mobile_image'), $name);  
                        $files = $name; 
                        
                        }
                }
                $data->mobile_image = $files;
            }
                
            
            $data->video_url = $request->video_url;
            $data->news_url = $request->news_url;
            $data->meta_title = $request->meta_title;
            $data->meta_keyword = $request->meta_keyword;
            $data->meta_description = $request->meta_description;
            $data->status = $request->status;
            $data->update();
           
        }
        else{

            $data = new NewsEvents;
            $data->event_name = $request->event_name;
            $data->type = $request->type;
            $data->start = $request->start;
            $data->description = $request->description;
            $data->choose = $request->choose;
            
            if($request->file)
                {
                    $filePath = 'upload/media/news_events/photo';
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
                            $file->move(public_path('upload/media/news_events/photo'), $name);  
                            $files = $name; 
                            
                            }
                    }
                    // dd($files);
                    $data->photo = $files;
                }
                if($request->mobile_image)
                {
                    $filePath = 'upload/media/news_events/mobile_image';
                    $path = public_path($filePath); 
                    if(!file_exists($path))
                    {
                        mkdir($path, 0777, true);
                    }
                        
                    $files = [];
                    if($request->hasfile('mobile_image'))
                    {
                            $file = $request->file('mobile_image');
                           
                            if($file->extension() == "png" || "jpg" || "jpeg")
                            {
                            $name = $file->getClientOriginalName();
                            $file->move(public_path('upload/media/news_events/mobile_image'), $name);  
                            $files = $name; 
                            
                            }
                    }
                    $data->mobile_image = $files;
                }
            $data->video_url = $request->video_url;
            $data->news_url = $request->news_url;
            $data->meta_title = $request->meta_title;
            $data->meta_keyword = $request->meta_keyword;
            $data->meta_description = $request->meta_description;
            $data->status = $request->status;
            $data->save();

        }
       Flash::success( __('action.saved', ['type' => 'News & Events']));
       return redirect()->route('events.index');
    }
    public function edit($id)
    {
        $events = NewsEvents::find($id);
       
        return view('admin.media.news_events.edit', compact('events'));
    }
    public function delete($id = null)
    {
        $state  = NewsEvents::find($id);
        $state->delete();
        Flash::success( __('action.deleted', ['type' => 'News & Events']));
        return redirect()->back();
    }
    public function status(Request $request)
    {
        $state  = NewsEvents::find($request->id);
        if($request->val == 1)
        {
            $state->status = 0;
            $state->save();
        }
        else{
            $state->status = 1;
            $state->save();
        }
        Flash::success( __('action.status', ['type' => 'News & Events']));

    }
    public function multipleImage($id)
    {
        // dd($id);
        // $ids = $id;
        $data = NewsEventImage::where('news_event_id',$id)->get();
        // dd($data);
        return view('admin.media.news_events.multipleImage',compact('id','data'));
    }
    
    public function uploadImages(Request $request) {
        // dd($request->all());
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('upload/media/news_events/multipleImage/'."$request->id"),$imageName);
        // $data  =   NewsEventImage::create(['image' => $imageName]);
        $data  = new NewsEventImage;
        $data->image = $imageName;
        $data->news_event_id = $request->id;
        $data->status = 1;
        $data->save();
        Flash::success( __('action.image', ['type' => 'Image']));
        return response()->json(["status" => "success", "data" => $data]);
    }
    public function deleteImage(Request $request) {
        $image = $request->file('filename');
        $filename =  $request->get('filename');
        NewsEventImage::where('image', $filename)->delete();
        // $path = public_path().'/images/'.$filename;
        $path = public_path().'/upload/media/news_events/multipleImage/'.$request->id.'/'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        Flash::success( __('action.deleted', ['type' => 'Image']));
        return $filename;
    }
    public function multipleImageDelete(Request $request)
    {
       $data = NewsEventImage::where('id',$request->id)->first();
       $data->status = 2 ;
       $data->delete();
        Flash::success( __('action.deleted', ['type' => 'Image']));
        // return redirect()->back(); 
    }
}
