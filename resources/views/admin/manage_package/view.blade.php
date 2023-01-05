@extends('admin.manage_package.layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
                Home Visit List
            </div>
           
        </div>
        <div class="card-body"> 
            
              <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                
            {{-- <thead class="row">  --}}
              
                   
                <tbody>
                    
                  
                  
                    <tr>
                        <td>Package Name:</td> <td>{{ $data['packageName'] }}</td>
                    </tr>
                   
                    <tr>
                        <td>Package Code:</td> <td>{{ $data['packageCode'] }}</td>
                    </tr>
                    <tr>
                        <td>cityId:</td> <td>{{ $data['cityId'] }}</td>
                    </tr>
                    <tr>
                        <td>cityName:</td> <td>{{ $data['cityName'] }}</td>
                    </tr>
                    <tr>
                        <td>testLists:</td> <td>{{ $data['testLists'] }}</td>
                    </tr>
                    <tr>
                        <td>testSchedule:</td> <td>{{ $data['testSchedule'] }}</td>
                    </tr>
                    <tr>
                        <td>sampleType:</td> <td>{{ $data['sampleType'] }}</td>
                    </tr>
                    <tr>
                        <td>ageRestrictions:</td> <td>{{ $data['ageRestrictions'] }}</td>
                    </tr>
                    <tr>
                        <td>preRequisties:</td> <td>{{ $data['preRequisties'] }}</td>
                    </tr>
                    
                    <tr>
                        <td>reportAvailability:</td> <td>{{ $data['reportAvailability'] }}</td>
                    </tr>
                    <tr>
                        <td>comments:</td> <td>{{ $data['comments'] }}</td>
                    </tr>
                    <tr>
                        <td>fees:</td> <td>{{ $data['fees'] }} ₹</td>
                    </tr>
                    <tr>
                        <td>homeVisit:</td> <td>{{ $data['homeVisit'] }}</td>
                    </tr>
                    <tr>
                        <td>discountFees:</td> <td>{{ $data['discountFees'] }}</td>
                    </tr>
                    <tr>
                        <td>Is Selected:</td> 
                        @if($data['is_selected'] == '1')
                            <td>Published</td>
                        @else
                            <td>Unpublished</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Meta Title:</td> <td>{{ $data['meta_title'] }}</td>
                    </tr>
                    <tr>
                        <td>Meta Description :</td> <td>{{ $data['meta_description'] }}</td>
                    </tr>
                    <tr>
                        <td>Meta Keyword :</td> <td>{{ $data['meta_keyword'] }}</td>
                    </tr>
                    <tr>
                        <td>Sorting Order :</td> <td>{{ $data['sorting_order'] }}</td>
                    </tr>

                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('manage_package.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
