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
       
        ->select('job_posts.id','job_posts.job_title','job_posts.department_id','job_posts.experience',
        'job_posts.education','job_posts.job_purpose','job_posts.responsibilities','departments.name as department_name','job_posts.status',
        'cities.cityId as cityId','cities.city as city','cities.stateId as stateId','cities.state as state')
        ->leftJoin('cities','cities.cityId','=','job_posts.cityId')
        ->leftJoin('departments','departments.id','job_posts.department_id')
        ->get(); 
        $currentOpening_count = count($currentOpening);
        return response()->json(['currentOpening_count'=>$currentOpening_count,'currentOpening'=>$currentOpening]);
    }
}
