<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banners::
        select('id','Title','Content','Url','DesktopImage','MobileImage','OrderBy')
        ->get(); 
            foreach($banner as $key=>$val)
            {
                if($val['MobileImage'])
                {
                    $val['MobileImage'] = asset($val['MobileImage']);
    
                }
            }
            foreach($banner as $key=>$val)
            {
                if($val['DesktopImage'])
                {
                    $val['DesktopImage'] = asset($val['DesktopImage']);
    
                }
            }

        return response()->json(['banner'=>$banner]);
    }
}
