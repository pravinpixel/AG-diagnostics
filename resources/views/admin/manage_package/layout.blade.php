@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['manage_package.index','manage_package.view','manage_package.create','manage_package.edit']) ? "active" : "" }}" href="{{ route('manage_package.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Manage Package
            </a>
        </li>
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection