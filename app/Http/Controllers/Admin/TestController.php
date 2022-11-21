<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

class TestController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()) {

            $data = Tests::select([
                "id",
                "TestId",
                "TestName", 
                "ApplicableGender",
                "IsPackage",
                "Classifications",
                "DriveThrough",
                "HomeCollection",
                "TestSchedule",
                "TestPrice"
            ]);

            return DataTables::eloquent($data)
                ->addIndexColumn()
                ->addColumn('Is_Package', function ($data) {
                    $flag    =  $data->IsPackage == 'No' ? 'danger' : 'success';
                    $type    =  $data->IsPackage == 'No' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                })
                ->addColumn('Applicable_Gender', function ($data) {
                    if($data->ApplicableGender == 'M') return '<span class="t-center"><i class="text-primary fa fa-mars me-2"></i>Male</span>';
                    if($data->ApplicableGender == 'F') return '<span class="t-center"><i class="text-info fa fa-venus me-2"></i>Female</span>';
                    if($data->ApplicableGender == 'B') return '<span class="t-center"><i class="text-success fa fa-mars me-2"></i><i class="fa fa-venus me-2"></i>Both</span>';
                    if($data->ApplicableGender == '') return '<span class="t-center">-</span>';
                })
                ->addColumn('Drive_Through', function ($data) {
                    $flag    =  $data->DriveThrough == 'N' ? 'danger' : 'success';
                    $type    =  $data->DriveThrough == 'N' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                })
                ->addColumn('Home_Collection', function ($data) {
                    $flag    =  $data->HomeCollection == 'N' ? 'danger' : 'success';
                    $type    =  $data->HomeCollection == 'N' ? 'ban' : 'check-circle';
                    $status  =  '<span class="fa-20 t-center fa fa-'.$type.' text-'.$flag.'"></span>';
                    return $status;
                }) 
                ->addColumn('Test_Schedule', function ($data) {
                    $TestSchedule  =  '<small>'.str_replace(',',' ' , $data->TestSchedule).'</small>';
                    return $TestSchedule;
                })
                ->addColumn('action', function ($data) {
                    return button('show', route('test.show', $data->id)).button('edit', route('test.edit', $data->id));
                })
                ->rawColumns(['action','Is_Package','Test_Schedule','Drive_Through','Home_Collection','Applicable_Gender'])
                ->make(true);
        }

        $last_sync  =   Carbon::parse(Tests::latest()->first()->created_at ?? "")->format('d/m/Y');

        return view('admin.master.tests.index',compact('last_sync'));
    }

    public function syncRequest()
    {
         
        $response = Http::get('http://reports.anandlab.com/listest/labapi.asmx/GetTestMaster', [
            'CorporateID'   =>    config('auth.CorporateID'),
            'passCode'      =>    config('auth.passCode'),
        ]);

        $response_data = json_decode($response->body())[0]->Data;
        
        foreach ($response_data as $data) {
            $test = Tests::updateOrCreate([
                "TestId"                            =>  $data->TestId ?? null,
                "DosCode"                           =>  $data->DosCode ?? null,
                "TestName"                          =>  $data->TestName ?? null,
                "AliasName1"                        =>  $data->AliasName1 ?? null,
                "AliasName2"                        =>  $data->AliasName2 ?? null,
                "ApplicableGender"                  =>  $data->ApplicableGender ?? null,
                "IsPackage"                         =>  $data->IsPackage ?? null,
                "Classifications"                   =>  $data->Classifications ?? null,
                "TransportCriteria"                 =>  $data->TransportCriteria ?? null,
                "SpecialInstructionsForPatient"     =>  $data->SpecialInstructionsForPatient ?? null,
                "SpecialInstructionsForCorporates"  =>  $data->SpecialInstructionsForCorporates ?? null,
                "SpecialInstructionsForDoctors"     =>  $data->SpecialInstructionsForDoctors ?? null,
                "BasicInstruction"                  =>  $data->BasicInstruction ?? null,
                "DriveThrough"                      =>  $data->DriveThrough ?? null,
                "HomeCollection"                    =>  $data->HomeCollection ?? null,
                "CteateDate"                        =>  $data->CteateDate ?? null,
                "ModifiedDate"                      =>  $data->ModifiedDate ?? null,
                "TestSchedule"                      =>  $data->TestSchedule ?? null,
                "TestPrice"                         =>  $data->TestPrice ?? null,
            ]);
          
            if($data->SubTestList != null) {
                 
                foreach ($data->SubTestList as  $subTest) {

                    $test->SubTestList()->create([
                        "SubTestId"         =>  $subTest->SubTestId,
                        "SubTestDOSCode"    =>  $subTest->SubTestDOSCode,
                        "SubTestName"       =>  $subTest->SubTestName,
                    ]);

                }
            }
            
        }

        Flash::success( __('masters.sync_success'));

        return redirect()->back();
    } 

    public function show($id)
    {
        $data   =   Tests::findOrFail($id);
        return view('admin.master.tests.show',compact('data'));
    }

    public function edit($id)
    {
        $data   =   Tests::findOrFail($id);
        return view('admin.master.tests.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data   =   Tests::findOrFail($id);
        $data->TestImages  = $request->TestImages;
        $data->save();

        Flash::success( __('masters.sync_success'));
        return redirect()->back();
    }
}