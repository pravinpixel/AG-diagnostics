@extends('admin.manage_career.layout')

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
                        <td>Name:</td> <td>{{ $data['name'] }}</td>
                    </tr>
                    <tr>
                        <td>Job Roll:</td> <td>{{ $data['job_title'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $data['phone'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                   
                    <tr>
                        <td>PDF:</td> <td><a href="{{ asset('website/upload/careers/'.$data['file']) }}" class="m-1  shadow-sm btn btn-sm text-primary btn-outline-light" title="Download" download> 
                            <i class="bi bi-download"></i>
                            </a></td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>Location:</td> <td>{{ $data['location'] }}</td>
                    </tr>
                    <tr>
                        <td>Cover Letter:</td> <td>{{ $data['cover_letter'] }}</td>
                    </tr>
                   
                    <tr>
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('admin_careers.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
