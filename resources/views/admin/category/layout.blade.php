@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
       
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['category.index','category.create','category.edit']) ? "active" : "" }}" href="{{ route('category.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                
                Category
            </a>
        </li>
        
       
        
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection