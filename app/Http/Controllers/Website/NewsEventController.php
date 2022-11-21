<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\NewsEvents;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use DB;
class NewsEventController extends Controller
{
    public function index(Request $request)
    {
        $year = $request['year'];
        $month = $request['month'];
       $event = NewsEvents::where('status',1)
       ->when(!empty($year), function($q) use ($year){
            $q->whereYear('start',$year);
        })
        ->when(!empty($month), function($q) use ($month){
            $q->whereMonth('start',$month);
        })
        ->get();

        foreach($event as $key=>$val)
        {
            if($val['photo'])
            {
            $val['photo'] = asset('public/upload/media/news_events/photo/'.$val['photo']);
            }
        }
        foreach($event as $key=>$val)
        {
            if($val['mobile_image'])
            {
            $val['mobile_image'] = asset('public/upload/media/news_events/mobile_image/'.$val['mobile_image']);
            }
        }
        return response()->json(['event'=>$event]);
    }
    public function newsDetail($id)
    {
        $event = NewsEvents::find($id);
        $event['photo'] = asset('public/upload/media/news_events/photo/'. $event['photo']);
        $event['mobile_image'] = asset('public/upload/media/news_events/mobile_image/'. $event['mobile_image']);
        return response()->json(['event'=>$event]);
    }
}
