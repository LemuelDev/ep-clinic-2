<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TreatmentController;
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

Route::get('/', function() {
    return view("homepage");
})->name("home");



Route::get('/login', [AuthController::class, 'login'])->name("login");

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
Route::get('/reservation/create', [PatientController::class, 'createReservations'])->name('patient.create');

Route::post('/reservation/post', [ReservationController::class, 'store'])->name('patient.store');

Route::get('/reservation/{reservation}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');

// admin
Route::get('/admin/appointments/pending', [AdminController::class, 'appointments'])->name('admin.appointments');

Route::get('/admin/appointments/ongoing', [AdminController::class, 'ongoingAppointments'])->name('admin.ongoingAppointments');

Route::get('/admin/appointment/track/{id}', [AdminController::class, 'trackAppointment'])->name('admin.trackReservation');

Route::get('/admin/appointment/complete/{id}', [AdminController::class, 'completeReservation'])->name('admin.completeReservation');

Route::get('/admin/appointment/noShow/{id}', [AdminController::class, 'noshowReservation'])->name('admin.rejectReservation');

Route::get('/admin/appointment/delete/{id}', [AdminController::class, 'deleteReservationAppointment'])->name('admin.deleteReservation');

Route::get('/admin/records/delete/{id}', [AdminController::class, 'deleteRecordAppointment'])->name('admin.deleteRecord');

Route::get('/admin/records/completed/', [AdminController::class, 'completedRecords'])->name('admin.records');

Route::get('/admin/records/no-show/', [AdminController::class, 'noshowRecords'])->name('admin.noshowRecords');

Route::get('/admin/profile/', [AdminController::class, 'profile'])->name('admin.profile');

Route::get('/admin/profile/edit/{id}', [AdminController::class, 'editProfile'])->name('admin.editProfile');

Route::post('/admin/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');

Route::get('/admin/profile/editPassword/{id}', [AdminController::class, 'editPassword'])->name('admin.editPassword');

Route::post('/admin/profile/update/{id}', [AdminController::class, 'updatePassword'])->name('admin.updatePassword');

Route::get("/admin/treatments", [TreatmentController::class, "index"])->name("admin.treatments");

Route::get("/admin/treatments/new", [TreatmentController::class, "add"])->name("treatment.add");

Route::post("/admin/treatments/store", [TreatmentController::class, "store"])->name("treatment.store");

Route::get("/admin/treatment/edit/{id}", [TreatmentController::class, "edit"])->name("treatment.edit");

Route::post("/admin/treatments/update/{id}", [TreatmentController::class, "update"])->name("treatment.update");

Route::get("/admin/treatments/delete/{id}", [TreatmentController::class, "delete"])->name("treatment.delete");



