<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\FindLabController;
use App\Http\Controllers\Website\TestimonialController;
use App\Http\Controllers\Website\HomeVisitController;
use App\Http\Controllers\Website\BookTestController;
use App\Http\Controllers\Website\MediaController;
use App\Http\Controllers\Website\ContactController;
use App\Http\Controllers\Website\CareersController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\PackagesController;
use App\Http\Controllers\Website\RequestCallBackController;
/* 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('website.home');
// })->name("home_page");

// Route::get('/', [HomeController::class, 'index'])->name('home_page');

Route::post('/request-call', [RequestCallBackController::class, 'store'])->name('request-call.store');

 
Route::get('/about-us', function () {
    return view('website.about');
});

Route::get('/our-brands', function () {
    return view('website.brands');
});

Route::get('/select-phc', function () {
    return view('website.select-phc');
});

Route::get('/our-team', function () {
    return view('website.our-team');
});

Route::get('/awards', function () {
    return view('website.awards');
});

Route::get('/accreditation', function () {
    return view('website.accreditation');
});

// Route::get('/testimonials', function () {
//     return view('website.testimonials');
// });
Route::get('/testimonials', [TestimonialController::class, 'testimonials'])->name('website.testimonials');

// Route::get('/book-a-test', function () {
//     return view('website.book-test');
// });
Route::get('/book-a-test', [BookTestController::class, 'index'])->name('book-test.index');
Route::post('/book-a-test', [BookTestController::class, 'store'])->name('book-test.store');

Route::get('/test-details', function () {
    return view('website.test-details');
});

// Route::get('/home-visit', function () {
//     return view('website.home-visit');
// });
// Route::get('/home-visit', [HomeVisitController::class, 'index'])->name('home-visit.index');
// Route::post('/home-visit', [HomeVisitController::class, 'store'])->name('home-visit.store');

Route::get('/corporate-wellness', function () {
    return view('website.corporate-wellness');
});

Route::get('/electrocardiogram', function () {
    return view('website.electrocardiogram');
});

Route::get('/clinical-lab-management', function () {
    return view('website.clinical-lab-management');
});

Route::get('/premier-home-care', function () {
    return view('website.premier-home-care');
});

Route::get('/loyalty-card', function () {
    return view('website.loyalty-card');
});

Route::get('/infrastructure', function () {
    return view('website.infrastructure');
});

Route::get('/find-a-lab', [FindLabController::class, 'findLab'])->name('website.find-a-lab');
// Route::get('/find-a-lab', function () {
//     return view('website.find_lab.find-lab');
// });

Route::get('/contact-us', function () {
    return view('website.contact-us');
});
Route::get('/contact-us', [ContactController::class, 'index'])->name('contact-us.index');
Route::post('/contact-us', [ContactController::class, 'store'])->name('contact-us.store');

// Route::get('/careers', function () {
//     return view('website.careers');
// });
// Route::get('/careers', [CareersController::class, 'index'])->name('careers.index');
// Route::post('/careers', [CareersController::class, 'store'])->name('careers.store');

Route::get('/packages', function () {
    return view('website.packages');
});


Route::get('/news-and-events/events-details/{id}', [MediaController::class, 'newsEventDetails'])->name('website.news_event');

Route::get('/news-and-events', [MediaController::class, 'eventIndex'])->name('website.event');

Route::get('/media', [MediaController::class, 'mediaIndex'])->name('website.media');


// Route::get('/master-health-checkup', function () {
//     return view('website.master-health-checkup');
// });
Route::get('/master-health-checkup', [PackagesController::class, 'masterHealthCheckupIndex'])->name('master-health-checkup.index');
Route::get('/executive-health-checkup', [PackagesController::class, 'executiveHealthCheckIndex'])->name('executive-health-checkup.index');
Route::get('/wellness-package-women', [PackagesController::class, 'wellnessPackageWomenIndex'])->name('wellness-package-women.index');
Route::get('/child-health-checkup', [PackagesController::class, 'childHealthCheckupIndex'])->name('child-health-checkup.index');
Route::get('/senior-citizen-health-checkup', [PackagesController::class, 'seniorCitizenHealthCheckupIndex'])->name('senior-citizen-health-checkup.index');
Route::get('/pre-marital-health-checkup', [PackagesController::class, 'preMaritalHealthCheckupIndex'])->name('pre-marital-health-checkup.index');
Route::get('/pre-employment-health-checkup', [PackagesController::class, 'preEmploymentHealthCheckupIndex'])->name('pre-employment-health-checkup.index'); 

Route::post('/package-store', [PackagesController::class, 'packageStore'])->name('package-store.store');


Route::get('/thanks-you', function () {
    return view('website.formsubmit');
});


// Route::get('/executive-health-checkup', function () {
//     return view('website.executive-health-checkup');
// });



// Route::get('/wellness-package-women', function () {
//     return view('website.wellness-package-women');
// });


// Route::get('/child-health-checkup', function () {
//     return view('website.child-health-checkup');
// });




// Route::get('/senior-citizen-health-checkup', function () {
//     return view('website.senior-citizen-health-checkup');
// });



// Route::get('/pre-marital-health-checkup', function () {
//     return view('website.pre-marital-health-checkup');
// });

// Route::get('/pre-employment-health-checkup', function () {
//     return view('website.pre-employment-health-checkup');
// });

Route::get('/contact', function () {
    return view('website.contact');
});
