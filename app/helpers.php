<?php

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\City;
use App\Models\Admin\ManagePackage;
use App\Models\Admin\State;
use App\Models\Admin\ManageTest;
use App\Models\Admin\HomeVisit;
use App\Models\Admin\HomeVisitArea;
use App\Models\Admin\SampleCollectionCenters;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Http;


if(!function_exists('asset_url')) {
    function asset_url($value)
    {
        if(!is_null($value)) {
            if(Storage::exists($value)){
                return url('/storage/app/'.$value);
            }
        }
        return asset('images/no-image.jpg');
    }
}

function insertApiCityData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responseCity = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/Cities');
      $responseCity = json_decode($responseCity);
      if(!is_null($responseCity)) {
        // City::truncate();
        foreach($responseCity as $key =>$val){
          $stateData = State::where('stateId',$val->stateId)->select('id','stateId')->first();
          
          $data = [
            'country_id' => "1",
            'cityId' => $val->cityId,
            'city' => $val->city,
            'stateId' => $val->stateId,
            'state_id' => $stateData->id,
            'state' => $val->state,
            'status' => 1,
        ];
         $res = City::updateOrCreate($data);
      }
      }
      return "City data save successfully";
  }
  function insertApiStateData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responseState = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/States');
      $responseState = json_decode($responseState);
      if(!is_null($responseState)) {
        foreach($responseState as $key =>$val){
          // State::truncate();
          $data = [
            'country_id' => "1",
            'stateId' => $val->stateId,
            'state' => $val->state,
            'status' => 1,
        ];
         $res = State::updateOrCreate($data);
      }
      }
      return "State data save successfully";
  }
  function insertApiTestData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responseTest = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/Tests');
      $responseTest = json_decode($responseTest);
      if(!is_null($responseTest)) {
        foreach($responseTest as $key =>$val){
          // ManageTest::truncate();
          $data = [
            'primaryId'=>$val->primaryId,
            'testName'=>$val->testName,
            'testCode'=>$val->testCode,
            'cityId'=>$val->cityId,
            'cityName'=>$val->cityName,
            'details'=>$val->details,
            'sample'=>$val->sample,
            'container'=>$val->container,
            'qty'=>$val->qty,
            'storage'=>$val->storage,
            'method'=>$val->method,
            'comments'=>$val->comments,
            'fees'=>$val->fees,
            'homeVisit'=>$val->homeVisit,
            'discountFees'=>$val->discountFees,
            'status' => 1,
        ];
         $res = ManageTest::updateOrCreate($data);
      }
      }
      return "Test data save successfully";
  }
  function insertApiPackagesData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responsePackages = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/Packages');
      $responsePackages = json_decode($responsePackages);
      if(!is_null($responsePackages)) {
        foreach($responsePackages as $key =>$val){
          // ManageTest::truncate();
          $data = [
            'primaryId'=>$val->primaryId,
            'packageName'=>$val->packageName,
            'packageCode'=>$val->packageCode,
            'cityId'=>$val->cityId,
            'cityName'=>$val->cityName,
            'testLists'=>$val->testLists,
            'testSchedule'=>$val->testSchedule,
            'sampleType'=>$val->sampleType,
            'ageRestrictions'=>$val->ageRestrictions,
            'preRequisties'=>$val->preRequisties,
            'reportAvailability'=>$val->reportAvailability,
            'comments'=>$val->comments,
            'fees'=>$val->fees,
            'homeVisit'=>$val->homeVisit,
            'discountFees'=>$val->discountFees,
            'status' => 1,
        ];
         $res = ManagePackage::updateOrCreate($data);
      }
      }
      return "Packages data save successfully";
  }

  function clientApiDataPass($data)
  {
    $apiURL = 'https://agdmatrix.dyndns.org/a/Pixel/HomeVisit';
 
    $response = Http::withToken('token')->withBasicAuth('agdpixel', 'p1x3l@agd')->post($apiURL, $data);
    return $response; 
  }

  function insertApiHomeVisitAreaData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responseHomeVisitArea = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/HomeVisitAreas');
      $responseHomeVisitArea = json_decode($responseHomeVisitArea);
      if(!is_null($responseHomeVisitArea)) {
        foreach($responseHomeVisitArea as $key =>$val){
          // ManageTest::truncate();
          $data = [
            'areaId'=>$val->areaId,
            'area'=>$val->area,
            'cityId'=>$val->cityId,
            'city'=>$val->city,
            'stateId'=>$val->stateId,
            'state'=>$val->state,
            'status' => 1,
        ];
         $res = HomeVisitArea::updateOrCreate($data);
      }
      }
      return "Home Visit Area data save successfully";
  }
  function insertApiSampleCollectionCentersData()
  {
      $key ='agdpixel';
      $secret ='p1x3l@agd';
      $responseSampleCollectionCenters = Http::withBasicAuth($key,$secret)
      ->get('https://agdmatrix.dyndns.org/a/Pixel/SampleCollectionCenters');
      $responseSampleCollectionCenters = json_decode($responseSampleCollectionCenters);
      if(!is_null($responseSampleCollectionCenters)) {
        foreach($responseSampleCollectionCenters as $key =>$val){
          // ManageTest::truncate();
          $data = [
            'centerId'=>$val->centerId,
            'localityId'=>$val->localityId,
            'location'=>$val->location,
            'timing'=>$val->timing,
            'address'=>$val->address,
            'cityId'=>$val->cityId,
            'city'=>$val->city,
            'stateId'=>$val->stateId,
            'state'=>$val->state,
            'phone'=>$val->phone,
            'email'=>$val->email,
            'latitude'=>$val->latitude,
            'longitude'=>$val->longitude,
            'googleReviewLink'=>$val->googleReviewLink,
            'whatsAppLink'=>$val->whatsAppLink,
            'status' => 1,
        ];
         $res = SampleCollectionCenters::updateOrCreate($data);
      }
      }
      return "Sample Collection Centers data save successfully";
  }
  
  function errorMessage()
  {
    Flash::error( __('action.permission'));
  }
  function successCall()
  {
    return response()->json(['Status'=>200,'Errors'=>false,'Message'=>'Created Successfully']);
  }
  function failedCall($data)
  {
    return response()->json(['Status'=>200,'Errors'=>true,'Message'=>$data]);
  }

if(!function_exists('auth_id')) {
    function auth_id()
    {  
        return Sentinel::getUser()->name;
    }
}

if(!function_exists('button')) {
    function button($type, $url)
    {  
        if($type == 'edit') {
            return '
                <a href="'.$url.'" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Edit"> 
                    <i class="bi bi-pencil"></i>
                </a>
            ';
        }

        if($type == 'delete') {
            return '
                <form method="post" action="'.$url.'" class="d-inline-block"> 
                        '.csrf_field().'
                    <button id="confirmDelete" type="submit" class="m-1 shadow-sm btn btn-sm text-danger btn-outline-light" title="Delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            ';
        }
        if($type == 'view') {
          return '
              <form method="get" action="'.$url.'" class="d-inline-block"> 
                     
                  <button id="" type="submit" class="m-1 shadow-sm btn btn-sm text-danger btn-outline-light" title="View">
                      <i class="bi bi-eye"></i>
                  </button>
              </form>
          ';
      }
         if($type == 'multipleImage') {
            return '
                <a href="'.$url.'" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="multipleImage"> 
                <i class="bi bi-image"></i>Add\View Image
                </a>
            ';
        }
        if($type == 'status') {
            return '
                
                <input href="'.$url.'" type="checkbox" checked data-toggle="toggle" title="Status">
               
                
            ';
        }

        if($type == 'show') {
            return '<a href="'.$url.'" class="m-1 shadow-sm btn btn-sm text-success btn-outline-light"><i class="fa fa-eye"></i></a>';
        }
    }

    function toggleButton($type, $url,$data)
    {
        if($type == 'status') {
            if($data->status == '1'){
                $checked = 'checked="checked"';
            }else{

                $checked = '';
            }
            return '<label class="switch">
            <input data-id="'.$url.'" type="checkbox" id="status"  onclick="statuschange('.$data->status.','.$data->id.')"  '.$checked.'>
            <div class="slider round"></div>
            </label>';
        
        
        }
       
    }
    function bookTestMailFunction($data)
    {
        // dd($data);
        $name = $data['name'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        $area = $data['area'];
        $test = $data['test'];
        $visit = $data['visit'];
        $date = $data['date'];
	
            // echo "nnn"; die();
                
            if (($name != '')&&($email != '')&&($mobile != '')) {
        
            $to  = '67santhosh@gmail.com,'.$email;
            
            $subject = 'Booking Test';
            
            $message = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="background: #f5f8fa;">
            <tbody>
              <tr>
                <td style="padding: 30px;"><table width="500" border="0" align="center" cellpadding="0" cellspacing="0" style="background: #fff;">
                  <tbody>
                    <tr>
                      <td align="center" style="background: #e1e1e1; padding: 15px; text-align:center;" >
                        <img src="http://192.168.0.56/phc/public/website/assets/images/logo.png" />
                      </td>
                    </tr>
                    <tr>
                      <td align="center" style="padding:20px; color: #8e8e8e; font-family:Helvetica, Arial; font-size:22px;">New submission on<br><b style="color:#db1690;">Book a Test </b><br>
                        &quot;Keep your health in check.&quot;</td>
                    </tr>
                    <tr>
                      <td style="padding: 20px; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Name</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$name.'</td>
                            </tr>
                          <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                            <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Email</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$email.'}}</td>
                            </tr>
                          <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                            <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Phone</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$mobile.' }}</td>
                            </tr>
                          <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Area</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$area.'</td>
                            </tr>
                          <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Test</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$test.'</td>
                            </tr>
                           <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Visit</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$visit.'</td>
                            </tr>
                             <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #929292; " >Date</td>
                            </tr>
                          <tr>
                            <td height="30" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >'.$date.'</td>
                            </tr>
                             <tr>
                            <td height="20" style="font-size: 16px; font-family:Helvetica, Arial; color: #454545; " >&nbsp;</td>
                            </tr>
                                     
                           
                          </tbody>
                        </table>';
            
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            //$headers .= 'From:'.$email. "\r\n";
            $headers .= 'From: info@inspacetech.com' . "\r\n";
            // $headers .= 'Bcc: websupport@pixel-studios.com' . "\r\n";
            
           $done =  mail($to, $subject, $message, $headers);
          	// dd($done);
            
                
            }
            
    }

}