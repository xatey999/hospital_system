<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//user's routes:
Route::get('/patientform', [PatientController::class,'index'])->name('patient.form');
Route::post('/patient/save',[PatientController::class,'save'])->name('patient.form.save');

Route::get('/doctordashboard', function () {
    return view('doctor.dashboard');
})->middleware(['auth', 'verified'])->name('doctor.dashboard');

Route::get('/doctordashboard/profile/{id}', [DoctorController::class,'profile'])->name('doctor.profile');
Route::post('/doctordashboard/update/{id}', [DoctorController::class,'update'])->name('doctor.update');

// Route::get('/doctorform', function () {
//     return view('doctor.form');
// })->middleware(['auth', 'verified'])->name('doctor.form');


Route::get('/doctor_form', [DepartmentController::class, 'index'])->middleware(['auth', 'verified'])->name('doctor.form');

Route::post('/doctor/save', [DoctorController::class,'save'])->name('doctor.save');

Route::get('/doctordashboard/edit/{id}', [DoctorController::class,'edit'])->name('doctorprofile.edit');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
