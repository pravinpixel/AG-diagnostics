@extends('admin.manage_test.layout')

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
                        <td>Test Name:</td> <td>{{ $data['testName'] }}</td>
                    </tr>
                   
                    <tr>
                        <td>Test Code:</td> <td>{{ $data['testCode'] }}</td>
                    </tr>
                   
                    <tr>
                        <td>cityId:</td> <td>{{ $data['cityId'] }}</td>
                    </tr>
                    <tr>
                        <td>cityName:</td> <td>{{ $data['cityName'] }}</td>
                    </tr>
                    <tr>
                        <td>Details:</td> <td>{{ $data['details'] }}</td>
                    </tr>
                    <tr>
                        <td>Sample:</td> <td>{{ $data['sample'] }}</td>
                    </tr>
                    <tr>
                        <td>Container:</td> <td>{{ $data['container'] }}</td>
                    </tr>
                    <tr>
                        <td>Qty:</td> <td>{{ $data['qty'] }}</td>
                    </tr>
                    <tr>
                        <td>Storage:</td> <td>{{ $data['storage'] }}</td>
                    </tr>
                    
                    <tr>
                        <td>Method:</td> <td>{{ $data['method'] }}</td>
                    </tr>
                    <tr>
                        <td>Comments:</td> <td>{{ $data['comments'] }}</td>
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
                        <td>  </td>
                         <td>  
                            <div class="col-10 offset-2">
                                <a href="{{ route('manage_test.index') }}" class="btn btn-primary">Back</a>
                            </div>
                        </td>
                    </tr>
                    
                </tbody>
               
            </table>  
        </div>
    </div>
@endsection
