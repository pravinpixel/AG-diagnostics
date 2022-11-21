@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
    @if($user->hasAccess('user.view.media_gallery')||$user->hasAccess('user.add.media_gallery'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['feature.index','feature.create','feature.edit']) ? "active" : "" }}" href="{{ route('feature.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Media Gallery
            </a>
        </li>
    @endif
    <?php $user = Sentinel::getUser();?>
    @if($user->hasAccess('user.view.media_news_event')||$user->hasAccess('user.add.media_news_event'))
 

        <li class="nav-item">
            <a class="nav-link {{ Route::is(['events.index','events.create','events.edit']) ? "active" : "" }}" href="{{ route('events.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                News & Events
            </a>
        </li>
    @endif
        {{-- <li class="nav-item">
            <a class="nav-link {{ Route::is(['events.multipleImage']) ? "active" : "" }}" href="{{ route('events.multipleImage') }}">
                <i class="fa fa-picture-o me-2"></i>
               Multiple Image
            </a>
        </li> --}}
        
        
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection