@extends('admin.manage_test.layout')

@section('admin_master_content')
<style>
    .btn-light {
  color: #fff;
  background-color: #848382;
  border-color: #848382;
}
    .btn-light:hover {
    color: #fff;
    background-color: var(--primary2);
    border-color: var(--primary3);
    }
</style>
    <div class="card custom">
        <div class="card-header">
            <div class="card-title">
                Edit Manage Test
            </div>
            <a href="{{ route('manage_test.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Manage Test List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::model($test,['route' => ['manage_test.store', $test->id], 'class'=>'needs-validation','novalidate', 'id' => 'manage_test_edit_form', 'method'=> 'post','files' => true]) !!}
                @csrf
                @include('admin.manage_test.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('manage_test.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 