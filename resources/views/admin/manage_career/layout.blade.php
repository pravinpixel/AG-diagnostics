@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
    
        @if($user->hasAccess('user.view.careers'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('admin_careers.index','admin_careers.view') ? "active" : "" }}" href="{{ route('admin_careers.index') }}">
                <i class="fa-building fa me-2"></i>
                Careers Enquiry
            </a> 
        </li>
        @endif
        @if($user->hasAccess('user.view.job-post') || $user->hasAccess('user.add.job-post'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('job-post.index','job-post.create','job-post.edit') ? "active" : "" }}" href="{{ route('job-post.index') }}">
                <i class="fa-building fa me-2"></i>
                Job List
            </a> 
        </li>
        @endif
        @if($user->hasAccess('user.view.department')||$user->hasAccess('user.add.department'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('department.index','department.create','department.edit') ? "active" : "" }}" href="{{ route('department.index') }}">
                <i class="fa-building fa me-2"></i>
                Department
            </a> 
        </li>
        @endif
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection