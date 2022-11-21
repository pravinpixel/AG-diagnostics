@extends('admin.media.layout')

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
                Edit News & Events
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-primary ms-3">
                <i class="fa fa-list me-2" aria-hidden="true"></i>
                Feature Stories List
            </a>
        </div>
        <div class="card-body"> 
            {!! Form::model($events,['route' => ['events.store', $events->id], 'class'=>'needs-validation','novalidate','id' => 'events_edit_form', 'method'=> 'post','files' => true]) !!}
                @csrf
                @include('admin.media.news_events.form')
                <div class="row ">
                    <div class="col-10 offset-2">
                        <a href="{{ route('events.index') }}" class="btn btn-light">Back</a>
                        <button type="submit" class="btn btn-primary fw-bold">Save</button>
                    </div>
                </div> 
            {!! Form::close() !!}
        </div>
    </div>
@endsection 