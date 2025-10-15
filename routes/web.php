<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\AnnualIncome\AnnualIncomeController;
use App\Http\Controllers\Web\BeAHost\QuestionController;
use App\Http\Controllers\Web\Blogs\BlogController;
use App\Http\Controllers\Web\CMS\PrivacyPolicyController;
use App\Http\Controllers\Web\CMS\TermsController;
use App\Http\Controllers\Web\ContactUS\ContactImageController;
use App\Http\Controllers\Web\ContactUS\ContactWebController;
use App\Http\Controllers\Web\ElectricianDay\ElectricianDayBannerController;
use App\Http\Controllers\Web\ElectricianDay\ElectricianDayImageController;
use App\Http\Controllers\Web\ElectricianDay\ElectricianDayPostController;
use App\Http\Controllers\Web\ElectricianDay\ElectricianDayVideoController;
use App\Http\Controllers\Web\GlobalElectricianDay\GlobalElectricianDayController;
use App\Http\Controllers\Web\GlobalElectricianDay\GlobalMultimediaController;
use App\Http\Controllers\Web\GlobalElectricianDay\MovementController;
use App\Http\Controllers\Web\GlobalElectricianDay\TimelineController;
use App\Http\Controllers\Web\GlobalElectricianEnrollRegistrations\GlobalElectricianRegistrationController;
use App\Http\Controllers\Web\GlobalElectricianSponsorWeb\GlobalElectricianSponsorController;
use App\Http\Controllers\Web\HostEnrollment\HostEnrollmentController;
use App\Http\Controllers\Web\OurServices\Category\ServiceCategoryController;
use App\Http\Controllers\Web\OurServices\PricingType\PricingTypeController;
use App\Http\Controllers\Web\OurServices\SubCategory\ServiceSubcategoryController;
use App\Http\Controllers\Web\ServiceCountry\CountryController;
use App\Http\Controllers\Web\ServiceCounty\CountyController;
use App\Http\Controllers\Web\ServiceParish\ParishController;
use App\Http\Controllers\Web\ServicePhoneNumber\PhoneNumberController;
use App\Http\Controllers\Web\ServiceZipCode\ZipCodeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('backend.layouts.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//Terms and conditions

Route::resource('web-terms', TermsController::class);
Route::resource('web-privacy-policies', PrivacyPolicyController::class);

//contact Us
Route::get('/contacts', [ContactWebController::class, 'index'])->name('contacts.web.index');
//contact-image-upload
Route::resource('web-contact-images', ContactImageController::class);

//cms/blogs
Route::resource('blogs', BlogController::class);

//CMS/ global-electrician-days
Route::resource('global-electrician-days', GlobalElectricianDayController::class);
Route::resource('timelines', TimelineController::class);
Route::resource('movements', MovementController::class);
Route::resource('global-multimedia', GlobalMultimediaController::class);
//CMS/ ElectricianDay
Route::resource('electricianDay-images', ElectricianDayImageController::class);
Route::resource('electricianDay-posts', ElectricianDayPostController::class)->except(['show']);
Route::resource('electrician-day-banners', ElectricianDayBannerController::class)->except(['show']);
Route::resource('electrician-day-videos', ElectricianDayVideoController::class);

Route::resource('hostEnrollments', HostEnrollmentController::class);

//ourServices/Category
Route::resource('service-categories', ServiceCategoryController::class);
//ourServices/Sub-Category
Route::resource('service-subcategories',ServiceSubcategoryController::class);
//ourServices/pricing_types
Route::resource('pricing-types', PricingTypeController::class);
//GlobalElectricianEnrollRegistrations
Route::get('/admin/global-electrician-registrations', [GlobalElectricianRegistrationController::class, 'index'])
    ->name('global-electrician-registrations.list');

// web.php
Route::post('registrations/{registration}/toggle-status', [GlobalElectricianRegistrationController::class, 'toggleStatus'])
    ->name('registrations.toggle-status');


//GlobalElectricianEnrollSponsor
Route::get('global-electrician-sponsors', [GlobalElectricianSponsorController::class, 'index'])
    ->name('backend.global_sponsors.index');

Route::post('sponsors/{sponsor}/toggle-status', [GlobalElectricianSponsorController::class, 'toggleStatus'])
    ->name('sponsors.toggle-status');

Route::post('enrollments/{id}/toggle-status', [HostEnrollmentController::class, 'toggleStatus'])
    ->name('enrollments.toggle-status');


Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/{id}', [QuestionController::class, 'show'])->name('questions.show');
    Route::get('/{id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/{id}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/{id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
});

Route::resource('countries', CountryController::class);
Route::resource('counties', CountyController::class);
Route::resource('parishes', ParishController::class);
Route::resource('zip_codes', ZipCodeController::class);
Route::resource('phone-numbers', PhoneNumberController::class);
Route::resource('annual-incomes', AnnualIncomeController::class);

require __DIR__.'/auth.php';
