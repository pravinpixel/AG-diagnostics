<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ManageLabController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\NewsEventsController;
use App\Http\Controllers\Admin\ManageTestController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\HomeVisitController;
use App\Http\Controllers\Admin\BookTestController;
use App\Http\Controllers\Admin\ManagePackageController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\CareersController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ApiConfigController;
use App\Http\Controllers\Admin\PaymentConfigController;
use App\Http\Controllers\Admin\PackagesController;
use App\Http\Controllers\Admin\RequestCallBackController;
use App\Http\Controllers\Admin\StateController;
use App\Http\Controllers\Admin\JobPostController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\BrochureController;
use App\Http\Controllers\Admin\HomeVisitAreaController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SampleCollectionCenterController;
use App\Http\Controllers\DashboardController;
use App\Models\Admin\HomeVisitArea;
use App\Models\Country;
use Illuminate\Support\Facades\Route;
 

Route::middleware(['auth_users'])->group(function () {

    Route::group(['prefix' => 'admin'], function(){
 
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');


        Route::get('settings', [SettingsController::class, 'index'])->name('admin.settings');
         
        // User Routes 
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user-delete/{id}', [UserController::class, 'destroy'])->name('user.delete');
        Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user-update/{id}', function () {   
            return redirect()->back();
        })->name('user.update');
        
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
        Route::get('/api-config', [ApiConfigController::class, 'index'])->name('api_config.index');
        Route::get('/api-config/create', [ApiConfigController::class, 'create'])->name('api_config.create');
        Route::get('/api-config/{id}', [ApiConfigController::class, 'edit'])->name('api_config.edit');
        Route::post('/api-config/{id?}', [ApiConfigController::class, 'updateOrCreate'])->name('api_config.store');
        Route::post('/api-config-delete/{id}', [ApiConfigController::class, 'destroy'])->name('api_config.delete');

        Route::get('/payment-config', [PaymentConfigController::class, 'index'])->name('payment_config.index');
        Route::get('/payment-config/create', [PaymentConfigController::class, 'create'])->name('payment_config.create');
        Route::get('/payment-config/{id}', [PaymentConfigController::class, 'edit'])->name('payment_config.edit');
        Route::post('/payment-config/{id?}', [PaymentConfigController::class, 'updateOrCreate'])->name('payment_config.store');
        Route::post('/payment-config-delete/{id}', [PaymentConfigController::class, 'destroy'])->name('payment_config.delete');



         // Role Routes 
        Route::get('/role', [RoleController::class, 'index'])->name('role.index');
        Route::post('/role', [RoleController::class, 'store'])->name('role.store');
        Route::get('/role-create', [RoleController::class, 'create'])->name('role.create');
        Route::post('/role-delete/{id}', [RoleController::class, 'destroy'])->name('role.delete');
        Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
        Route::put('/role-update/{id}', [RoleController::class, 'update'])->name('role.update');
        Route::get('/role-update/{id}', function () {   
            return redirect()->back();
        })->name('role.update');

        // Master 
        Route::get('master/branch', [BranchController::class, 'index'])->name('master.index');
        
        // Branch  Master
        // Route::post('master/branch', [BranchController::class, 'syncRequest'])->name('branch.sync');
        Route::get('master/branch/{id}', [BranchController::class, 'show'])->name('branch.show'); 

        // City Master
        // Route::get('master/city', [CityController::class, 'index'])->name('city.index');
        // Route::post('master/city', [CityController::class, 'syncRequest'])->name('city.sync');

        
        Route::get('category', [CategoryController::class, 'index'])->name('category.index');
        Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('category/{id}', [CategoryController::class, 'edit'])->name('category.edit'); 
        Route::post('category/{id?}', [CategoryController::class, 'store'])->name('category.store');
        Route::post('category/delete/{id?}', [CategoryController::class, 'delete'])->name('category.delete'); 
        Route::get('category/status/{id}', [CategoryController::class, 'status'])->name('category.status');
        // Test Master
        Route::get('master/test', [TestController::class, 'index'])->name('test.index');
        Route::get('master/test/{id}', [TestController::class, 'show'])->name('test.show');
        Route::get('master/test/edit/{id}', [TestController::class, 'edit'])->name('test.edit');
        Route::post('master/test/edit/{id}', [TestController::class, 'update'])->name('test.edit');
        Route::post('master/test', [TestController::class, 'syncRequest'])->name('test.sync');

        // Banner Master
        Route::get('master/banner', [BannerController::class, 'index'])->name('banner.index');
        Route::get('master/banner/create', [BannerController::class, 'create'])->name('banner.create');
        Route::get('master/banner/{id}', [BannerController::class, 'edit'])->name('banner.edit'); 
        Route::post('master/banner/{id?}', [BannerController::class, 'store'])->name('banner.store');
        Route::post('master/banner/delete/{id?}', [BannerController::class, 'delete'])->name('banner.delete'); 
        
        Route::get('master/country', [CountryController::class, 'index'])->name('country.index');
        Route::get('master/country/create', [CountryController::class, 'create'])->name('country.create');
        Route::get('master/country/{id}', [CountryController::class, 'edit'])->name('country.edit'); 
        Route::post('master/country/{id?}', [CountryController::class, 'store'])->name('country.store');
        Route::post('master/country/delete/{id?}', [CountryController::class, 'delete'])->name('country.delete'); 
        Route::get('master/country/status/{id}', [CountryController::class, 'status'])->name('country.status');

        Route::get('master/state', [StateController::class, 'index'])->name('state.index');
        Route::get('master/state/create', [StateController::class, 'create'])->name('state.create');
        Route::get('master/state/{id}', [StateController::class, 'edit'])->name('state.edit'); 
        Route::post('master/state/{id?}', [StateController::class, 'store'])->name('state.store');
        Route::post('master/state/delete/{id?}', [StateController::class, 'delete'])->name('state.delete'); 
        Route::get('master/state/status/{id}', [StateController::class, 'status'])->name('state.status');

        Route::get('master/city', [CityController::class, 'index'])->name('city.index');
        Route::get('master/city/create', [CityController::class, 'create'])->name('city.create');
        Route::get('master/city/{id}', [CityController::class, 'edit'])->name('city.edit'); 
        Route::post('master/city/{id?}', [CityController::class, 'store'])->name('city.store');
        Route::post('master/city/delete/{id?}', [CityController::class, 'delete'])->name('city.delete'); 
        Route::get('master/city/status/{id}', [CityController::class, 'status'])->name('city.status');

        Route::get('master/area', [AreaController::class, 'index'])->name('area.index');
        Route::get('master/area/create', [AreaController::class, 'create'])->name('area.create');
        Route::get('master/area/{id}', [AreaController::class, 'edit'])->name('area.edit'); 
        Route::post('master/area/{id?}', [AreaController::class, 'store'])->name('area.store');
        Route::post('master/area/delete/{id?}', [AreaController::class, 'delete'])->name('area.delete'); 
        Route::get('master/area/status/{id}', [AreaController::class, 'status'])->name('area.status');


        Route::get('enquiry/home_visit', [HomeVisitController::class, 'index'])->name('home_visit.index');
        Route::post('enquiry/home_visit/delete/{id?}', [HomeVisitController::class, 'delete'])->name('home_visit.delete'); 
        Route::get('enquiry/home_visit/status/{id}', [HomeVisitController::class, 'status'])->name('home_visit.status');
        Route::get('enquiry/home_visit/view/{id}', [HomeVisitController::class, 'view'])->name('home_visit.view');

        Route::get('enquiry/book_test', [BookTestController::class, 'index'])->name('book_test.index');
        Route::post('enquiry/book_test/delete/{id?}', [BookTestController::class, 'delete'])->name('book_test.delete'); 
        Route::get('enquiry/book_test/status/{id}', [BookTestController::class, 'status'])->name('book_test.status');

        Route::get('enquiry/contact-us', [ContactUsController::class, 'index'])->name('contact_us.index');
        Route::post('enquiry/contact-us/delete/{id?}', [ContactUsController::class, 'delete'])->name('contact_us.delete'); 
        Route::get('enquiry/contact-us/status/{id}', [ContactUsController::class, 'status'])->name('contact_us.status');

        Route::get('enquiry/request-call', [RequestCallBackController::class, 'index'])->name('enquiry_request_call.index');
        Route::post('enquiry/request-call/delete/{id?}', [RequestCallBackController::class, 'delete'])->name('enquiry_request_call.delete'); 
        Route::get('enquiry/request-call/status/{id}', [RequestCallBackController::class, 'status'])->name('enquiry_request_call.status');

        Route::get('enquiry/package', [PackagesController::class, 'index'])->name('enquiry_package.index');
        Route::post('enquiry/package/delete/{id?}', [PackagesController::class, 'delete'])->name('enquiry_package.delete'); 
        Route::get('enquiry/package/status/{id}', [PackagesController::class, 'status'])->name('enquiry_package.status');

        // Route::get('manage/branch', [BranchController::class, 'index'])->name('master.index');
        Route::get('manage', [ManageLabController::class, 'index'])->name('manage.index');
        Route::get('manage/create', [ManageLabController::class, 'create'])->name('manage.create');
        Route::get('manage/edit/{id}', [ManageLabController::class, 'edit'])->name('manage.edit'); 
        // Route::post('manage/delete/{id?}', [ManageLabController::class, 'delete'])->name('manage.state_id'); 
        Route::post('manage/{id?}', [ManageLabController::class, 'store'])->name('manage.store');
        Route::post('manage/delete/{id?}', [ManageLabController::class, 'delete'])->name('manage.delete'); 
        Route::get('manage/status/{id}', [ManageLabController::class, 'status'])->name('manage.status');
        Route::get('get/state', [ManageLabController::class, 'get_state'])->name('get.state');
        Route::get('get/city', [ManageLabController::class, 'get_city'])->name('get.city');
        Route::get('get/area', [ManageLabController::class, 'get_area'])->name('get.area');
        Route::get('manage/city_id/{id}', [ManageLabController::class, 'get_city'])->name('manage.city_id');
        Route::get('manage/area_id/{id}', [ManageLabController::class, 'get_area'])->name('manage.area_id');
        Route::post('manage/update/{id}', [ManageLabController::class, 'update'])->name('manage.update');
        

        Route::get('feature/story', [FeatureController::class, 'index'])->name('feature.index');
        Route::get('feature/story/create', [FeatureController::class, 'create'])->name('feature.create');
        Route::get('feature/story/{id}', [FeatureController::class, 'edit'])->name('feature.edit'); 
        Route::post('feature/story/{id?}', [FeatureController::class, 'store'])->name('feature.store');
        Route::post('feature/story/delete/{id?}', [FeatureController::class, 'delete'])->name('feature.delete'); 
        Route::get('feature/story/status/{id}', [FeatureController::class, 'status'])->name('feature.status');
        Route::get('feature.delete-Pdf', [FeatureController::class, 'deletePdf'])->name('feature.delete-Pdf');

        Route::get('news/events', [NewsEventsController::class, 'index'])->name('events.index');
        Route::get('news/events/create', [NewsEventsController::class, 'create'])->name('events.create');
        Route::get('news/events/{id}', [NewsEventsController::class, 'edit'])->name('events.edit'); 
        Route::post('news/events/{id?}', [NewsEventsController::class, 'store'])->name('events.store');
        Route::post('news/events/delete/{id?}', [NewsEventsController::class, 'delete'])->name('events.delete'); 
        Route::get('news/events/status/{id}', [NewsEventsController::class, 'status'])->name('events.status');
       
        Route::get('news/events/multipleImage/{id}', [NewsEventsController::class, 'multipleImage'])->name('events.multipleImage'); 
        Route::get('multipleImage/delete', [NewsEventsController::class, 'multipleImageDelete'])->name('multipleImage.delete'); 

        Route::post('store', [NewsEventsController::class, 'uploadImages'])->name('dropzone.store'); //multiple image store
        Route::post('delete', [NewsEventsController::class, 'deleteImage'])->name('dropzone.delete'); //multiple image delete

        Route::get('manage/test', [ManageTestController::class, 'index'])->name('manage_test.index');
        Route::get('manage/test/create', [ManageTestController::class, 'create'])->name('manage_test.create');
        Route::get('manage/test/{id}', [ManageTestController::class, 'edit'])->name('manage_test.edit'); 
        Route::get('manage/test/view/{id}', [ManageTestController::class, 'view'])->name('manage_test.view');

        Route::post('manage_test/store/{id?}', [ManageTestController::class, 'store'])->name('manage_test.store');
        Route::post('manage/test/delete/{id?}', [ManageTestController::class, 'delete'])->name('manage_test.delete'); 
        Route::get('manage/test/status/{id}', [ManageTestController::class, 'status'])->name('manage_test.status');

        Route::get('testimonial', [TestimonialController::class, 'index'])->name('testimonial.index');
        Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
        Route::get('testimonial/{id}', [TestimonialController::class, 'edit'])->name('testimonial.edit'); 
        Route::post('testimonial/store/{id?}', [TestimonialController::class, 'store'])->name('testimonial.store');
        Route::post('testimonial/delete/{id?}', [TestimonialController::class, 'delete'])->name('testimonial.delete'); 
        Route::get('testimonial/status/{id}', [TestimonialController::class, 'status'])->name('testimonial.status');


        Route::get('manage/package', [ManagePackageController::class, 'index'])->name('manage_package.index');
        Route::get('manage/package/create', [ManagePackageController::class, 'create'])->name('manage_package.create');
        Route::get('manage/package/{id}', [ManagePackageController::class, 'edit'])->name('manage_package.edit'); 
        Route::post('manage_package/{id?}', [ManagePackageController::class, 'store'])->name('manage_package.store');
        Route::post('manage/package/delete/{id?}', [ManagePackageController::class, 'delete'])->name('manage_package.delete'); 
        Route::get('manage/package/status/{id}', [ManagePackageController::class, 'status'])->name('manage_package.status');
        Route::get('manage/package/view/{id}', [ManagePackageController::class, 'view'])->name('manage_package.view');


        Route::get('enquiry/careers', [CareersController::class, 'index'])->name('admin_careers.index');
        Route::post('enquiry/careers/delete/{id?}', [CareersController::class, 'delete'])->name('admin_careers.delete'); 
        Route::get('enquiry/careers/status/{id}', [CareersController::class, 'status'])->name('admin_careers.status');
        Route::get('enquiry/careers/resume/{id}', [CareersController::class, 'download'])->name('admin_resume.download');
        Route::get('enquiry/careers/view/{id}', [CareersController::class, 'view'])->name('admin_careers.view');

        Route::get('careers/job-post', [JobPostController::class, 'index'])->name('job-post.index');
        Route::get('careers/job-post/create', [JobPostController::class, 'create'])->name('job-post.create');
        Route::post('careers/job-post/store/{id?}', [JobPostController::class, 'store'])->name('job-post.store');
        Route::get('careers/job-post/status/{id?}', [JobPostController::class, 'status'])->name('job-post.status');
        Route::post('careers/job-post/delete/{id?}', [JobPostController::class, 'delete'])->name('job-post.delete'); 
        Route::get('careers/job-post/{id}', [JobPostController::class, 'edit'])->name('job-post.edit'); 

        Route::get('careers/department', [DepartmentController::class, 'index'])->name('department.index');
        Route::get('careers/department/create', [DepartmentController::class, 'create'])->name('department.create');
        Route::post('careers/department/store/{id?}', [DepartmentController::class, 'store'])->name('department.store');
        Route::get('careers/department/status/{id?}', [DepartmentController::class, 'status'])->name('department.status');
        Route::post('careers/department/delete/{id?}', [DepartmentController::class, 'delete'])->name('department.delete'); 
        Route::get('careers/department/{id}', [DepartmentController::class, 'edit'])->name('department.edit'); 

        Route::get('brochures', [BrochureController::class, 'index'])->name('brochures.index');
        Route::get('brochures/create', [BrochureController::class, 'create'])->name('brochures.create');
        Route::get('brochures/{id}', [BrochureController::class, 'edit'])->name('brochures.edit'); 
        Route::post('brochures/{id?}', [BrochureController::class, 'store'])->name('brochures.store');
        Route::post('brochures/delete/{id?}', [BrochureController::class, 'delete'])->name('brochures.delete'); 
        Route::get('brochures/status/{id}', [BrochureController::class, 'status'])->name('brochures.status');
        Route::get('brochures_delete/{id}', [BrochureController::class, 'brochureDelete'])->name('brochures_delete');
        Route::post('brochures/update/{id}', [BrochureController::class, 'update'])->name('brochures.update');

        Route::get('home-visit-area', [HomeVisitAreaController::class, 'index'])->name('home-visit-area.index');
        Route::get('home-visit-area/status/{id}', [HomeVisitAreaController::class, 'status'])->name('home-visit-area.status');
        Route::post('home-visit-area/delete/{id?}', [HomeVisitAreaController::class, 'delete'])->name('home-visit-area.delete'); 

        Route::get('sample-collection-center', [SampleCollectionCenterController::class, 'index'])->name('sample-collection-center.index');
        Route::get('sample-collection-center/view/{id}', [SampleCollectionCenterController::class, 'view'])->name('sample-collection-center.view');
        Route::get('sample-collection-center/status/{id}', [SampleCollectionCenterController::class, 'status'])->name('sample-collection-center.status');
        Route::post('sample-collection-center/delete/{id?}', [SampleCollectionCenterController::class, 'delete'])->name('sample-collection-center.delete'); 

    }); 
});