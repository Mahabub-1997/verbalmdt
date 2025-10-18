<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\BeAHost\QuestionController;
use App\Http\Controllers\API\Blogs\BlogApiController;
use App\Http\Controllers\API\ContactUs\ContactController;

use App\Http\Controllers\API\ElectricianDayApi\ElectricianDayBannerApiController;
use App\Http\Controllers\API\ElectricianDayApi\ElectricianDayImageApiController;
use App\Http\Controllers\API\ElectricianDayApi\ElectricianDayPostApiController;
use App\Http\Controllers\API\ElectricianDayApi\ElectricianDayVideoApiController;
use App\Http\Controllers\API\GlobalElectricianDayApi\GlobalElectricianDayController;
use App\Http\Controllers\API\GlobalElectricianDayApi\GlobalMultimediaApiController;
use App\Http\Controllers\API\GlobalElectricianDayApi\MovementApiController;
use App\Http\Controllers\API\GlobalElectricianDayApi\TimelineApiController;
use App\Http\Controllers\API\GlobalElectricianRegistrations\GlobalElectricianRegistrationApiController;
use App\Http\Controllers\API\GlobalElectricianSponsor\GlobalElectricianSponsorApiController;
use App\Http\Controllers\API\HostEnrollmentApi\HostEnrollmentApiController;
use App\Http\Controllers\API\PrivacyPolicy\PrivacyPolicyController;
use App\Http\Controllers\API\ProviderService\ProviderServiceController;
use App\Http\Controllers\API\ServiceProvider\ServiceProviderController;
use App\Http\Controllers\API\Terms\TermController;
use Illuminate\Support\Facades\Route;


// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Logged-in user routes (sanctum protected)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('password/request-otp', [AuthController::class, 'requestOtp']);
    Route::post('password/verify-otp', [AuthController::class, 'verifyOtpAndUpdate']);
});

// Forgot password (no login required)
Route::post('password/forgot', [AuthController::class, 'forgotPassword']);
Route::post('password/reset', [AuthController::class, 'resetPassword']);
Route::post('password/verify-otp', [AuthController::class, 'verifyOtpForgotPassword']);

//cms
Route::apiResource('contacts', ContactController::class);
Route::get('contact-images', [ContactController::class, 'imagesGet']);
Route::get('/terms', [TermController::class, 'index']);
Route::get('/privacy-policies', [PrivacyPolicyController::class, 'index']);

//global-electrician-registrations
Route::post('/global-electrician-registrations', [GlobalElectricianRegistrationApiController::class, 'store']);

//global-electrician-Sponsor
Route::post('global-electrician-sponsors', [GlobalElectricianSponsorApiController::class, 'store']);


Route::apiResource('/api-blogs', BlogApiController::class);



Route::get('/global-electrician-days', [GlobalElectricianDayController::class, 'index']);
Route::get('/global-electrician-days/{id}', [GlobalElectricianDayController::class, 'show']);

Route::get('/timelines', [TimelineApiController::class, 'index']);
Route::get('/timelines/{id}', [TimelineApiController::class, 'show']);

Route::get('/movements', [MovementApiController::class, 'index']);
Route::get('/movements/{id}', [MovementApiController::class, 'show']);

Route::get('/global-multimedia', [GlobalMultimediaApiController::class, 'index']);
Route::get('/global-multimedia/{id}', [GlobalMultimediaApiController::class, 'show']);

Route::get('/electrician-day-banners', [ElectricianDayBannerApiController::class, 'index']);
Route::get('/electrician-day-banners/{id}', [ElectricianDayBannerApiController::class, 'show']);

Route::get('/electrician-day-posts', [ElectricianDayPostApiController::class, 'index']);
Route::get('/electrician-day-posts/{id}', [ElectricianDayPostApiController::class, 'show']);

Route::get('/electrician-day-images', [ElectricianDayImageApiController::class, 'index']);
Route::get('/electrician-day-images/{id}', [ElectricianDayImageApiController::class, 'show']);

Route::get('/electrician-day-videos', [ElectricianDayVideoApiController::class, 'index']);
Route::get('/electrician-day-videos/{id}', [ElectricianDayVideoApiController::class, 'show']);

Route::get('/questions', [QuestionController::class, 'index']);
Route::get('/questions/{id}', [QuestionController::class, 'show']);



Route::post('/host-enrollments', [HostEnrollmentApiController::class, 'store']);
Route::get('/host-enrollments', [HostEnrollmentApiController::class, 'index']);


Route::post('/service-providers', [ServiceProviderController::class, 'store']);
Route::post('/provider-services', [ProviderServiceController::class, 'store']);
