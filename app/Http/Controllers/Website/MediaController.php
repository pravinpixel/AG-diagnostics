<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\FeatureStories;
use App\Models\Admin\NewsEvents;
use App\Models\Admin\NewsEventImage;
use App\Mail\HomeVisitMail;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class MediaController extends Controller
{
    public function index()
    {
        $media = FeatureStories::
        select('id','story_title','date','story_url','description','pdf','video_link')
        ->get();
        foreach($media as $key=>$val)
        {
            if($val['pdf'])
            {
            $val['pdf'] = asset('public/upload/media/feature/image/'.$val['pdf']);
            }
        }
        return response()->json(['media'=>$media]);
    }
    public function mediaDetail($id)
    {
        $media = FeatureStories::
        select('id','story_title','date','story_url','description','pdf','video_link')
        ->find($id);
        if(!empty($media))
        {
            if($media['pdf'])
            {
                $media['pdf'] = asset('public/upload/media/feature/image/'. $media['pdf']);
            }
            return response()->json(['media'=>$media]);
        }
        else{
            return response()->json(['Message'=>"Data not Find"]);
        }
            
        
    }
  
}
