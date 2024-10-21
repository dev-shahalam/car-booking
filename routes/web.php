<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes Start

//Auth web routes
Route::get('register', [UserController::class, 'registerPage'])->name('register');
Route::get('login', [UserController::class, 'loginPage'])->name('login');
Route::get('send-otp', [UserController::class, 'sendEmailPage'])->name('send-otp');
Route::get('submit-otp', [UserController::class, 'submitOtpPage'])->name('submit-otp');
Route::get('change-password', [UserController::class, 'changePasswordPage'])->name('change-password');

Route::get('dashboard', [UserController::class, 'adminDashboard'])->name('dashboard')
    ->middleware(AuthMiddleware::class);

Route::get('dashboard/profile', [UserController::class, 'adminProfile'])
    ->name('dashboard/profile')
    ->middleware(AuthMiddleware::class);




// Route::get('/', [UserController::class, 'userDashboard'])->name('home')
//     ->middleware(AuthMiddleware::class);

// Route::get('/', [UserController::class, 'genarelUser'])->name('homepage');
// // ->middleware(AuthMiddleware::class);

Route::get('/', [UserController::class, 'homePage'])->name('home');





// Auth API routes

Route::post('register-user', [UserController::class, 'registerUser'])->name('register-user');
Route::post('login-user', [UserController::class, 'loginUser'])->name('login-user');
// ->middleware(AuthMiddleware::class);
Route::get('logout', [UserController::class, 'logout'])->name('logout')
->middleware(AuthMiddleware::class);

Route::post('send-otp', [UserController::class, 'sendOtp'])->name('send-otp');
Route::post('submit-otp', [UserController::class, 'submitOtp'])->name('submit-otp');
Route::post('change-password', [UserController::class, 'changePassword'])->name('change-password');

Route::post('update-admin', [UserController::class, 'updateAdminProfile'])->name('update-admin')
    ->middleware(AuthMiddleware::class);

// Auth Routes End




// Car Routes Start

Route::get('car-page', [CarController::class, 'carList'])->name('car-page')
    ->middleware(AuthMiddleware::class);

Route::get('car-create', [CarController::class, 'carCreatePage'])->name('car-create')
    ->middleware(AuthMiddleware::class);

Route::get('car-update/{id}', [CarController::class, 'carUpdatePage'])->name('car-update')
    ->middleware(AuthMiddleware::class);

Route::post('create-car', [CarController::class, 'carCreate'])->name('create-car')
    ->middleware(AuthMiddleware::class);

Route::post('update-car/{id}', [CarController::class, 'carUpdate'])->name('update-car')
    ->middleware(AuthMiddleware::class);

Route::delete('delete-car/{id}', [CarController::class, 'carDelete'])->name('delete-car')
    ->middleware(AuthMiddleware::class);

Route::get('single-car/{id}', [CarController::class, 'singleCarPage'])->name('single-car')
    ->middleware(AuthMiddleware::class);


// Car Routes End

// Customer Route Start

Route::get('customer-page', [CustomerController::class, 'customerPage'])->name('customer-page')
    ->middleware(AuthMiddleware::class);

Route::get('customer-list', [CustomerController::class, 'customerList'])->name('customer-list')
    ->middleware(AuthMiddleware::class);

Route::get('update-customer/{id}', [CustomerController::class, 'updateCustomerPage'])->name('update-customer')
    ->middleware(AuthMiddleware::class);

Route::post('update-customer/{id}', [CustomerController::class, 'updateCustomer'])->name('update-customer')
    ->middleware(AuthMiddleware::class);

Route::delete('delete-customer/{id}', [CustomerController::class, 'deleteCustomer'])->name('delete-customer')
    ->middleware(AuthMiddleware::class);

// Customer Route End



// Rental Route Start

Route::get('rental', [RentalController::class, 'carBooking'])->name('rental')
->middleware(AuthMiddleware::class);



Route::get('/get-price/{id}', [RentalController::class, 'getPrice'])->name('get.price')
->middleware(AuthMiddleware::class);


Route::post('rental', [RentalController::class, 'store'])->name('rental.store')
->middleware(AuthMiddleware::class);


Route::get('rental-history/{id}', [RentalController::class, 'rentalHistory'])->name('rental-history')
->middleware(AuthMiddleware::class);

Route::get('rental-page', [RentalController::class, 'rentalPage'])->name('rental-page')
->middleware(AuthMiddleware::class);

Route::PUT('update-status/{id}', [RentalController::class, 'updateStatus'])->name('update-status')
->middleware(AuthMiddleware::class);



Route::delete('delete-rental/{id}', [RentalController::class, 'deleteRental'])->name('delete-rental')
->middleware(AuthMiddleware::class);





// Rental Route End
