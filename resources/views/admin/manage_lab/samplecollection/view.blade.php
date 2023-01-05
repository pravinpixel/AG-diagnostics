@extends('admin.manage_lab.manage_layout')

@section('admin_master_content')
    
    <div class="card custom table-card">
        <div class="card-header">
            <div class="card-title">
            Sample Collection Center
            </div>
           
        </div>
        <div class="card-body"> 
            
              <table class="table table-bordered table-centered m-0 tr-sm table-hover" id="data-table">
                
            {{-- <thead class="row">  --}}
              
                   
                <tbody>
                    
                    <tr>
                        <td>centerId:</td> <td>{{ $data['centerId'] }}</td>
                    </tr>
                    <tr>
                        <td>localityId:</td> <td>{{ $data['localityId'] }}</td>
                    </tr>
                    <tr>
                        <td>location:</td> <td>{{ $data['location'] }}</td>
                    </tr>
                    <tr>
                        <td>timing:</td> <td>{{ $data['timing'] }}</td>
                    </tr>
                    <tr>
                        <td>address:</td> <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>cityId:</td> <td>{{ $data['cityId'] }}</td>
                    </tr>
                    <tr>
                        <td>city:</td> <td>{{ $data['city'] }}</td>
                    </tr>

                    <tr>
                        <td>stateId:</td> <td>{{ $data['stateId'] }}</td>
                    </tr>
                    <tr>
                        <td>state:</td> <td>{{ $data['state'] }}</td>
                    </tr>

                    <tr>
                        <td>phone:</td> <td>{{ $data['phone'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>longitude:</td> <td>{{ $data['longitude'] }}</td>
                    </tr>
                    <tr>
                        <td>googleReviewLink:</td> <td><a href="{{ $data['googleReviewLink'] }}" target="_blank">{{ $data['googleReviewLink'] }}</a></td>
                    </tr>
                    <tr>
                        <td>whatsAppLink:</td> <td ><a href="{{ $data['whatsAppLink'] }}" target="_blank">{{ $data['whatsAppLink'] }}</a></td>
                    </tr>
                    <tr>
                        <td>Sorting Order:</td> <td ><a href="{{ $data['sorting_order'] }}" target="_blank">{{ $data['sorting_order'] }}</a></td>
                    </tr>
                   
                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('sample-collection-center.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
