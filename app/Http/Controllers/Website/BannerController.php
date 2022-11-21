<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banner = Banners::get(); 
            foreach($banner as $key=>$val)
            {
                if($val['MobileImage'])
                {
                    $val['MobileImage'] = asset('public/upload/files/mobile_images/'.$val['MobileImage']);
    
                }
            }
            foreach($banner as $key=>$val)
            {
                if($val['DesktopImage'])
                {
                    $val['DesktopImage'] = asset('public/upload/files/desktop_images/'.$val['DesktopImage']);
    
                }
            }

        return response()->json(['banner'=>$banner]);
    }
}
