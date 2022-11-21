<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobPost;
use Illuminate\Http\Request;

class CurrentOpeningController extends Controller
{
    public function index()
    {
        $currentOpening = JobPost::where('status',1)->get(); 
        return response()->json(['currentOpening'=>$currentOpening]);
    }
}
