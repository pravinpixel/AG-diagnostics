@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
        
    <?php $user = Sentinel::getUser();?>
    {{-- @if($user->hasAccess('user.view.manage_lab')||$user->hasAccess('user.add.manage_lab')) --}}
        {{-- <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('manage.index','manage.create','manage.edit') ? "active" : "" }}" href="{{ route('manage.index') }}">
                <i class="fa-building fa me-2"></i>
                Manage Lab Master 
            </a> 
        </li> --}}
    {{-- @endif --}}
    @if($user->hasAccess('user.view.home_visit_area')||$user->hasAccess('user.add.home_visit_area'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('home-visit-area.index','home-visit-area.view') ? "active" : "" }}" href="{{ route('home-visit-area.index') }}">
                <i class="fa-building fa me-2"></i>
                Home Visit Area
            </a> 
        </li>
    @endif 
    @if($user->hasAccess('user.view.sample_collection')||$user->hasAccess('user.delete.sample_collection'))
    <li class="nav-item d-flex">
        <a class="nav-link {{ Route::is('sample-collection-center.index','sample-collection-center.view','sample-collection-center.edit') ? "active" : "" }}" href="{{ route('sample-collection-center.index') }}">
            <i class="fa-building fa me-2"></i>
            Sample Collection Center
        </a> 
    </li>
    @endif

   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection
