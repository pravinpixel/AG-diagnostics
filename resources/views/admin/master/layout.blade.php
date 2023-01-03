@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::is(["master.index",'branch.show']) ? "active" : "" }}" href="{{ route('master.index') }}">
                <i class="fa-cog fa me-2"></i>
                Branch Master
            </a>
        </li>
        --}}
        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::is(['test.index','test.show','test.edit']) ? "active" : "" }}" href="{{ route('test.index') }}">
                <i class="fa fa-flask me-2"></i>
                Test Master
            </a>
        </li> --}}
        @if($user->hasAccess('user.view.banner')||$user->hasAccess('user.add.banner'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['banner.index','banner.create','banner.edit']) ? "active" : "" }}" href="{{ route('banner.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Banner Master
            </a>
        </li>
        @endif
        
        @if($user->hasAccess('user.view.manage_country'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['country.index','country.create','country.edit']) ? "active" : "" }}" href="{{ route('country.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Country Master
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_state'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['state.index','state.create','state.edit']) ? "active" : "" }}" href="{{ route('state.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                State Master
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_city'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('city.index','city.create','city.edit') ? "active" : "" }}" href="{{ route('city.index') }}">
                <i class="fa-building fa me-2"></i>
                City Master 
            </a> 
        </li>
        @endif
        {{-- @if($user->hasAccess('user.view.manage_area')||$user->hasAccess('user.add.manage_area')) --}}
        {{-- <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('area.index','area.create','area.edit') ? "active" : "" }}" href="{{ route('area.index') }}">
                <i class="fa-building fa me-2"></i>
                Area Master 
            </a> 
        </li> --}}
        {{-- @endif --}}
        {{-- <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('manage.index','manage.create','manage.edit') ? "active" : "" }}" href="{{ route('manage.index') }}">
                <i class="fa-building fa me-2"></i>
                Manage Lab Master 
            </a> 
        </li> --}}
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection