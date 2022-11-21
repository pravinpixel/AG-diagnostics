@extends('admin.master.layout')

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
                Edit Area 
            </div>
            <a href="{{ route('area.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Area List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::model($area,['route' => ['area.store', $area->id], 'class'=>'needs-validation','novalidate', 'id' => 'area_edit_form', 'method'=> 'post','files' => true]) !!}
                @csrf
                @include('admin.master.area.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('area.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 