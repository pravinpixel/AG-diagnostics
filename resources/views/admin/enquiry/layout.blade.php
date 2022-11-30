@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
    @if($user->hasAccess('user.view.home_visit'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('home_visit.index','home_visit.create','home_visit.view') ? "active" : "" }}" href="{{ route('home_visit.index') }}">
                <i class="fa-building fa me-2"></i>
                Home Visit
            </a> 
        </li>
        @endif
        
        @if($user->hasAccess('user.view.packages'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('enquiry_package.index') ? "active" : "" }}" href="{{ route('enquiry_package.index') }}">
                <i class="fa-building fa me-2"></i>
                Packages
            </a> 
        </li>
        @endif       
        {{-- @if($user->hasAccess('user.view.request_call_back'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('enquiry_request_call.index') ? "active" : "" }}" href="{{ route('enquiry_request_call.index') }}">
                <i class="fa-building fa me-2"></i>
                Request Call Back
            </a> 
        </li>
        @endif --}}
        {{-- @if($user->hasAccess('user.view.careers'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('admin_careers.index') ? "active" : "" }}" href="{{ route('admin_careers.index') }}">
                <i class="fa-building fa me-2"></i>
                Careers
            </a> 
        </li>
        @endif --}}
        {{-- @if($user->hasAccess('user.view.test_booking'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('book_test.index','book_test.create') ? "active" : "" }}" href="{{ route('book_test.index') }}">
                <i class="fa-building fa me-2"></i>
                Test Booking
            </a> 
        </li>
        @endif --}}
        @if($user->hasAccess('user.view.contact_us'))
        <li class="nav-item d-flex">
            <a class="nav-link {{ Route::is('contact_us.index') ? "active" : "" }}" href="{{ route('contact_us.index') }}">
                <i class="fa-building fa me-2"></i>
                Contact Us
            </a> 
        </li>
        @endif
             
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection