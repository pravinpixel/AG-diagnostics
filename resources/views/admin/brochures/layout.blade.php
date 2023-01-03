@extends('layouts.admin')

@section('admin_title') Home @endsection

@section('admin_content')
   <ul class="nav nav-gradient w-100">
    <?php $user = Sentinel::getUser();?>
    @if($user->hasAccess('user.view.brochures')||$user->hasAccess('user.add.brochures'))
        <li class="nav-item">
            <a class="nav-link {{ Route::is(['brochures.index','brochures.create','brochures.edit']) ? "active" : "" }}" href="{{ route('brochures.index') }}">
                <i class="fa fa-picture-o me-2"></i>
                Brochure
            </a>
        </li>
        @endif
   </ul>
   <div class="my-4">
      @yield('admin_master_content')
   </div>
@endsection