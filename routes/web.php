<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReservationController;
use Illuminate\Support\Facades\Route;

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


// login, signup, forgot-pass, reset-pass....

Route::get('/', [AuthController::class, 'login'])->name("login");

Route::post('/auth', [AuthController::class , 'authenticate'])->name("user.auth");

Route::get('/signup', [AuthController::class, 'signup'])->name("signup");

Route::post('/signup', [AuthController::class,'store'])->name('users.store');

Route::post('/logout', [AuthController::class , 'logout'])->name('logout');

Route::get('password/reset', [PasswordResetController::class, 'showLinkRequestForm'])
    ->name('password.request');

// Handle sending the password reset link
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Show the form to reset the password
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

// Handle the password reset form submission
Route::post('password/reset/', [PasswordResetController::class, 'reset'])
    ->name('password.update');



// posting reservationsss
Route::get('/patient/reservation/create', [PatientController::class, 'createReservations'])->name('patient.create');

Route::post('/patient/reservation/post', [ReservationController::class, 'store'])->name('patient.store');



// admin
Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');

Route::get('/admin/records', [AdminController::class, 'records'])->name('admin.records');

Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');

Route::get('/admin/profile/edit/{id}', [AdminController::class, 'editProfile'])->name('admin.editProfile');



