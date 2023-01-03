<div class="d-flex flex-column flex-shrink-0 text-white   side_bar" style="width: 280px;">
    <a href="{{ route('admin.dashboard') }}" class="d-flex shadow border-light align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none" style="border-bottom: 1px solid #ffffff24 !important">
        <img src="{{ asset('images/logo/logo.jpg') }}" alt="logo" width="70%" class="mx-auto">
    </a>
    <ul class="nav nav-pills flex-column mb-auto mt-3 pt-0 p-3">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white {{ Route::is('admin.dashboard') ? "active" : "" }}" aria-current="page">
                <i class="bi bi-speedometer2 me-3"></i>Dashboard</a>
            </a>
        </li>
        {{-- <li>
            <a href="#" class="nav-link text-white">
            <i class="fa fa-shopping-cart me-3"></i>Manage Orders
            </a>
        </li> --}}
        {{-- <li>
            <a href="#" class="nav-link text-white">
                <i class="bi bi-person-lines-fill me-3"></i>Manage Customers
            </a>
        </li> --}}
       <?php $user = Sentinel::getUser();?>
       @if($user->hasAccess('user.view.category')||$user->hasAccess('user.add.category')||$user->hasAccess('user.edit.category'))
        <li>
            <a href="{{ route('category.index') }}" class="nav-link text-white {{ Route::is(['category.index','category.create','category.edit']) ? "active" : "" }}">
                <i class="fa fa-cubes me-3"></i>Manage Category
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.media_gallery')||$user->hasAccess('user.add.media_gallery')||$user->hasAccess('user.view.media_news_event')||$user->hasAccess('user.add.media_news_event'))
        <li>
            <a href="{{ route('feature.index') }}" class="nav-link text-white {{ Route::is(['feature.index','feature.create','feature.edit','events.index','events.create','events.edit','events.multipleImage']) ? "active" : "" }}">
                <i class="fa fa-microphone me-4"></i>Manage Media
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.home_visit_area')||$user->hasAccess('user.view.sample_collection'))
        <li>
            <a href="{{ route('home-visit-area.index') }}" class="nav-link text-white {{ Route::is(['manage.index','manage.create','manage.edit','home-visit-area.index','sample-collection-center.index','sample-collection-center.view']) ? "active" : "" }}">
                <i class="fa fa-thermometer-three-quarters me-4"></i>Manage Lab
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_testimonial')||$user->hasAccess('user.add.manage_testimonial'))
        <li>
            <a href="{{ route('testimonial.index') }}" class="nav-link text-white {{ Route::is(['testimonial.index','testimonial.create','testimonial.edit']) ? "active" : "" }}">
                <i class="fa fa-weixin me-3"></i>Manage Testimonial
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_test'))
        <li>
            <a href="{{ route('manage_test.index') }}" class="nav-link text-white {{ Route::is(['manage_test.index','manage_test.view','manage_test.create','manage_test.edit']) ? "active" : "" }}">
                <i class="fa fa-file-text-o me-3"></i>Manage Test
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_package'))
        <li>
            <a href="{{ route('manage_package.index') }}" class="nav-link text-white {{ Route::is(['manage_package.index','manage_package.view','manage_package.create','manage_package.edit']) ? "active" : "" }}">
                <i class="fa fa-database me-3"></i>Manage Package
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.manage_country')||$user->hasAccess('user.view.manage_state')||$user->hasAccess('user.view.manage_city')|| $user->hasAccess('user.view.brochures'))
        <li>
            <a href="{{ route('banner.index') }}" class="nav-link text-white {{ Route::is(['master.index','branch.show','area.index','area.create','area.edit','city.index','city.create','city.edit','country.index','country.create','country.edit','state.index','state.create','state.edit', 'banner.edit', 'test.edit' , 'banner.create', 'banner.index']) ? "active" : "" }}">
                <i class="fa fa-cogs me-3"></i>Manage Master
            </a>
        </li>
        @endif


        @if($user->hasAccess('user.view.brochures')||$user->hasAccess('user.add.brochures'))
        <li>
            <a href="{{ route('brochures.index') }}" class="nav-link text-white {{ Route::is(['brochures.index','brochures.create','brochures.edit']) ? "active" : "" }}">
                <i class="fa fa-file-pdf-o me-3"></i>Brochure Upload
            </a>
        </li>
        @endif


        @if($user->hasAccess('user.view.home_visit')||$user->hasAccess('user.view.packages')||$user->hasAccess('user.view.contact_us'))
        <li>
            <a href="{{ route('home_visit.index') }}" class="nav-link text-white {{ Route::is(['home_visit.index','home_visit.view','book_test.index','contact_us.index','enquiry_request_call.index','enquiry_package.index']) ? "active" : "" }}">
                <i class="fa fa-pencil-square-o me-3"></i>Manage Enquiries
            </a>
        </li>
        @endif
        @if($user->hasAccess('user.view.careers')||$user->hasAccess('user.view.job-post')||$user->hasAccess('user.view.department')||$user->hasAccess('user.add.department'))
        <li>
            <a href="{{ route('admin_careers.index') }}" class="nav-link text-white {{ Route::is(['admin_careers.index','admin_careers.view','job-post.index','job-post.create','job-post.edit','department.index','department.create','department.edit']) ? "active" : "" }}">
                <i class="fa fa-briefcase me-3"></i>Manage Careers
            </a>
        </li>
        @endif

        @if(Sentinel::getUser()->roles[0]->name == "Super Admin")
        <li>
            <a href="{{ route('admin.settings') }}" class="nav-link text-white {{ Route::is([
                    'admin.settings',
                    'user.index',
                    'user.create',
                    'user.edit',
                    'role.index',
                    'role.create', 
                    'role.edit',
                    'test.index',
                    'test.show',
                    'api_config.index',
                    'api_config.edit',
                    'api_config.create',
                    'payment_config.index',
                    'payment_config.edit',
                    'payment_config.create',
                ]) ? "active" : "" }}">
                <i class="fa fa-cogs me-3"></i>Settings
            </a>
        </li>
        @endif
    </ul>
    <!-- <hr>
    <div class="dropdown p-3 pt-0">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="http://www.staroceans.org/w3c/img_avatar.png" alt="" width="32" height="32" class="rounded-5 me-2">
            <b>{{ Sentinel::getUser()->name }}</b> 
            <small class="ms-2 badge bg-success text-white">
                {{ Sentinel::getUser()->roles[0]->name }}
            </small>
        </a>
        <ul class="dropdown-menu dropdown-menu-light text-small shadow" aria-labelledby="dropdownUser1" style="">
            <li><a class="dropdown-item" href="#">New Orders...</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#" onclick="return document.getElementById('logout_form').submit()">Sign out</a></li>
        </ul>
    </div> -->
</div>

<form action="{{ route('logout') }}" method="POST" id="logout_form">@csrf</form>