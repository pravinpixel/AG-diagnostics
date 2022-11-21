@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
    @if($user->hasAccess('user.view.manage_testimonial')||$user->hasAccess('user.add.manage_testimonial'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['testimonial.index','testimonial.create','testimonial.edit']) ? "active" : "" }}" href="{{ route('testimonial.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Manage Testimonial
            </a>
        </li>
        @endif
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection