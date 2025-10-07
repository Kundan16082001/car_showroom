<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerHomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestDriveController;
use App\Http\Controllers\PurchaseController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// carcontroller routes

// Route::get('/cars/add', [CarController::class, 'create'])->name('cars.create');
// Route::post('/cars/store', [CarController::class, 'store'])->name('cars.store');

// landingController route
Route::get('/',[LandingController::class,'landingpage'])->name('landing');
// contact form route
Route::get('/contact',[LandingController::class,'showContactForm'])->name('contact.form');
Route::post('/contact',[LandingController::class,'submitContactForm'])->name('contact.submit');

// signup controller routes
Route::get('/signup',[SignupController::class,'create'])->name('signup.create');
Route::post('/signup',[SignupController::class,'store'])->name('signup.store');

// login controller routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// dashboard controller routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth'); // only authenticated users


//  Car CRUD

// *agar koi folder ka complete file ko route dena ho toh ham is method ka use kar sakte hai jisme 
// *Route::resource('folder_name',NameController::class); dena hoga aur controller me normal public function 
// *laga kar hum vhai se specific redirect kara skte hai with condition likestore edit show update delete 
// *validation auth sabhi type ke iske routing ke wjaha se jayda routing command dene ki jarurat nahi hai 
Route::resource('cars', CarController::class);

// Logout
Route::post('/logout', function() {Auth::logout();return redirect()->route('login');})->name('logout');

// CustomerHomeController routes
Route::get('/home',[CustomerHomeController::class,'index'])->name('home');


// User controller route
Route::resource('users', UserController::class);

// Test Drive Routes
Route::get('/test-drive', [TestDriveController::class, 'create'])->name('testdrives.create');
Route::post('/test-drive', [TestDriveController::class, 'store'])->name('testdrives.store');

// Admin routes
Route::get('/admin/test-drives', [TestDriveController::class, 'index'])->name('testdrives.index');
Route::patch('/admin/test-drives/{id}', [TestDriveController::class, 'updateStatus'])->name('testdrives.updateStatus');

//Customer Routes

Route::middleware(['auth'])->group(function() {
    Route::get('/purchases/create/{testDriveId}',[PurchaseController::class,'create'])->name('purchases.create');
    Route::get('/purchases/store',[PurchaseController::class,'store'])->name('purchases.store');
    Route::get('/purchases/my-purchases',[PurchaseController::class,'myPurchases'])->name('purchases.myPurchases');
});

//admin routes

Route::middleware(['auth'])->group(function() {
    Route::get('/admin/purhases',[PurchaseController::class,'index'])->name('purchases.index');
    Route::get('/admin/purhases/{id}/update-status',[PurchaseController::class,'updateStatus'])->name('purchases.updateStatus');
});



