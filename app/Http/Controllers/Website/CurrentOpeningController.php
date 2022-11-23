<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobPost;
use Illuminate\Http\Request;

class CurrentOpeningController extends Controller
{
    public function index()
    {
        $currentOpening = JobPost::where('job_posts.status',1)
        ->select('job_posts.*','departments.name as department_name')
        ->leftjoin('departments','departments.id','job_posts.department_id')
        ->get(); 
        return response()->json(['currentOpening'=>$currentOpening]);
    }
}
