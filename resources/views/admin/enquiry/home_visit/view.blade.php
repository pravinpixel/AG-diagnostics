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
                
           
                   
                <tbody>
                    
                    <tr>
                        <td>Package Name:</td> 
                        <td>
                            <table class="table table-striped" style="max-width:60%">
                                <tbody> 
                            <?php
                            if(!empty($data['packageName']))
                            {
                                foreach($data['packageName'] as $key =>$title)
                                {
                                    ?>
                                    <tr>
                                        <?php echo $title ?>
                                    </tr>
                                    <?php
                                }
                            }
                            else{
                                echo "-";
                            }
                            ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td> Test Name:</td> 
                            <td>
                                
                                <table class="table table-striped" style="max-width:60%">
                                    <tbody> 
                            <?php
                            if(!empty($data['testName']))
                            {
                                foreach($data['testName'] as $key =>$title)
                                {
                                    ?>
                                    <tr>
                                        <?php echo $title ?>
                                    </tr>
                                   <?php
                                }
                            }
                            else{
                                echo "-";
                            }
                            ?>
                        </tbody>
                    </table>
                        </td>
                    </tr>


                    <tr>
                        <td>First Name:</td> <td>{{ $data['first_name'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile:</td> <td>{{ $data['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Email:</td> <td>{{ $data['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Address:</td> <td>{{ $data['address'] }}</td>
                    </tr>
                    <tr>
                        <td>City:</td> <td>{{ $data['city'] }}</td>
                    </tr>
                    <tr>
                        <td>Area:</td> <td>{{ $data['area'] }}</td>
                    </tr>
                    <tr>
                        <td>Date:</td> <td>{{ $data['date'] }}</td>
                    </tr>
                    <tr>
                        <td>Remark:</td> <td>{{ $data['remark'] }}</td>
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
