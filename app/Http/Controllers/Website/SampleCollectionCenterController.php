<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\SampleCollectionCenters;
use Illuminate\Http\Request;

class SampleCollectionCenterController extends Controller
{
  
    public function index(Request $request)
    {
        $search = $request['search'];
        $id = $request['cityId'];
        $data = SampleCollectionCenters::where('status',1)
        ->select('id','centerId','localityId','location','timing','address','cityId','city','stateId','state','phone','email','latitude','longitude','googleReviewLink','whatsAppLink')
       
        ->when(!empty($id), function($q) use ($id){
            $q->where('cityId',$id);
        })
        ->when(!empty($search), function($q) use ($search){
            $q->where('sample_collection_centers.city','like','%'.$search.'%')
            ->orWhere('sample_collection_centers.address','like','%'.$search.'%')
            ->orWhere('sample_collection_centers.phone','like','%'.$search.'%')
            ->orWhere('sample_collection_centers.location','like','%'.$search.'%');
        })
        ->get();
        return response()->json(['data'=>$data]);
    }
}
