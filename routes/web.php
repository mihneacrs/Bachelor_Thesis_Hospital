<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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


Route::get('/', [HomeController::class,'index']);

Route::get('/home', [HomeController::class,'redirect'])->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/add_doctor_view', [AdminController::class,'addview']);

Route::post('/upload_doctor', [AdminController::class,'upload']);

Route::post('/appointment', [HomeController::class,'appointment']);

Route::get('/myappointment', [HomeController::class,'myappointment']);

Route::get('/cancel_appoint/{id}', [HomeController::class,'cancel_appoint']);

Route::get('/showappointment', [AdminController::class,'showappointment']);

Route::get('/approved/{id}', [AdminController::class,'approved']);

Route::get('/cancelled/{id}', [AdminController::class,'cancelled']);

Route::get('/showdoctor', [AdminController::class,'showdoctor']);

Route::get('/deletedoctor/{id}', [AdminController::class,'deletedoctor']);

Route::get('/updatedoctor/{id}', [AdminController::class,'updatedoctor']);

Route::post('/editdoctor/{id}', [AdminController::class,'editdoctor']);

Route::get('/emailview/{id}', [AdminController::class,'emailview']);

Route::post('/sendemail/{id}', [AdminController::class,'sendemail']);

Route::get('/view', [AdminController::class,'view']);

Route::post('/importuser',[AdminController::class,'importuser']);

Route::get('/exportuser',[AdminController::class,'exportuser']);

Route::post('/importdoctor',[AdminController::class,'importdoctor']);

Route::get('/exportdoctor',[AdminController::class,'exportdoctor']);

Route::post('/importappointment',[AdminController::class,'importappointment']);

Route::get('/exportappointment',[AdminController::class,'exportappointment']);

Route::get('/chat', [HomeController::class,'chat']);

Route::get('/about', [HomeController::class,'about']);

Route::get('/doctors', [HomeController::class,'doctors']);

Route::get('/home1', [HomeController::class,'home1']);

Route::get('/blog', [HomeController::class,'blog']);

Route::get('/contact', [HomeController::class,'contact']);

Route::get('/add_product_view', [AdminController::class,'addviewproduct']);

Route::get('/showproduct', [AdminController::class,'showproduct']);

Route::post('/upload_product', [AdminController::class,'uploadproduct']);

Route::get('/deleteproduct/{id}', [AdminController::class,'deleteproduct']);

Route::get('/updateproduct/{id}', [AdminController::class,'updateproduct']);

Route::post('/editproduct/{id}', [AdminController::class,'editproduct']);

Route::get('/searchDoctor', [AdminController::class,'searchDoctor']);

Route::get('/terms_and_conditions', [HomeController::class,'terms_and_conditions']);

Route::post('/contactemail', [HomeController::class,'contactemail']);