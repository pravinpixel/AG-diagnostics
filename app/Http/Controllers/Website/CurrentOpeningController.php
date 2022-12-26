<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\JobPost;
use Illuminate\Http\Request;

class CurrentOpeningController extends Controller
{
    public function index()
    {
        $currentOpening = JobPost::with('city')->where('job_posts.status',1)
       
        ->select('job_posts.id','job_posts.job_title','job_posts.cityId','job_posts.department_id','job_posts.experience','job_posts.education','job_posts.job_purpose','job_posts.responsibilities','departments.name as department_name')
        ->leftjoin('departments','departments.id','job_posts.department_id')
        ->get(); 
        $currentOpening_count = count($currentOpening);
        return response()->json(['currentOpening_count'=>$currentOpening_count,'currentOpening'=>$currentOpening]);
    }
}
