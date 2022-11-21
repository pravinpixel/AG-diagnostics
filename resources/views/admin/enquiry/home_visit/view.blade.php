@extends('admin.enquiry.layout')

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
                        <td>Package:</td> <td>{{ $data['package'] }}</td>
                    </tr>
                    <tr>
                        <td>Title:</td> <td>{{ $data['title'] }}</td>
                    </tr>
                    <tr>
                        <td>First Name:</td> <td>{{ $data['first_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Last Name:</td> <td>{{ $data['last_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $data['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Gender:</td> <td>{{ $data['gender'] }}</td>
                    </tr>
                    <tr>
                        <td>DOB:</td> <td>{{ $data['dob'] }}</td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td> <td>{{ $data['date'] }}</td>
                    </tr>
                    <tr>
                        <td>Timing:</td> <td>{{ $data['timing'] }}</td>
                    </tr>
                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('home_visit.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
