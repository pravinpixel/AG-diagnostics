@extends('admin.manage_package.layout')

@section('admin_master_content')
<style>
    .btn-light:hover {
    color: #fff;
    background-color: var(--primary2);
    border-color: var(--primary3);
    }
</style>
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Create Manage Package
            </div>
            <a href="{{ route('manage_package.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Manage Package List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::open(['route' => 'manage_package.store','class'=>'needs-validation','novalidate',  'id' => 'manage_package_form', 'method'=> 'post', 'files' => true]) !!}
                @csrf
                @include('admin.manage_package.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('manage_package.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary fw-bold submit" id="submit" >Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 
{{-- <script>
    if ($("#manage_package_form").length > 0) {
        $("#manage_package_form").validate({
 
            rules: {
                package: {
                    required: true,
                    maxlength: 50
                },
 
                // code: {
                //     required: true,
                // },
 
                // description: {
                //     required: true,
                // },
            },
            messages: {
 
                package: {
                    required: "Please enter title",
                },
                // code: {
                //     required: "Please enter valid email",
                // },
                
                //  description: {
                //     required: "Please enter message",
                // },
            },
        })
    } 
 </script> --}}