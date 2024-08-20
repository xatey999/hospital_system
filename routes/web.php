<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    $user = Auth::user(); // Get the authenticated user

    // Check the role and return the appropriate view
    if ($user->role === 'doctor') {
        return redirect()->route('doctor.dashboard'); // Redirect to doctor dashboard
    } else {
        return view('dashboard'); // Return the default dashboard view
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
//patient's routes:
Route::get('/patientform', [PatientController::class,'index'])->name('patient.form');
Route::post('/patient/save',[PatientController::class,'save'])->name('patient.form.save');

//for appointment in patient's view
Route::get('/appointment/form/{id}',[AppointmentController::class,'index'])->name('appointment.form');
Route::post('/appointment/form/save',[AppointmentController::class,'store'])->name('appointment.store');

//for doctor's list in patient's view
Route::get('/doctorlist',[PatientController::class,'doctorlist'])->name('doctors.list');

//appointment list in patient's view
Route::get('/appointments/list/',[AppointmentController::class,'list'])->name('appointment.list');

Route::get('/appointment/cancel/{id}',[AppointmentController::class,'cancel'])->name('appointment.cancel');

});




//routes for doctor:
// Route::get('/doctordashboard', function () {
//     return view('doctor.dashboard');
// })->middleware(['auth', 'verified'])->name('doctor.dashboard');

Route::get('/doctordashboard', function () {
    $user = Auth::user(); // Get the authenticated user

    // Check the role and return the appropriate view
    if ($user->role === 'user') {
        return redirect()->route('dashboard'); // Redirect to user dashboard
    } else {
        return view('doctor.dashboard'); // Return the doctor's dashboard view
    }
})->middleware(['auth', 'verified'])->name('doctor.dashboard');

Route::middleware('auth')->group(function () {
//for doctor's profile
Route::get('/doctordashboard/profile/{id}', [DoctorController::class,'profile'])->name('doctor.profile');
Route::post('/doctordashboard/update/{id}', [DoctorController::class,'update'])->name('doctor.update');


//for schedules in doctor's view
Route::resource('schedules', ScheduleController::class);
Route::post('/schedules/update/{id}', [ScheduleController::class,'update'])->name('schedules.update');


//for appointment list in doctor's view
Route::get('/appointment/list', [DoctorController::class,'appointment'])->name('doctor.appointment.list');
Route::get('/appointment/edit/{id}', [DoctorController::class,'reschedulePage'])->name('appointment.reschedule');
Route::patch('/appointment/reschedule/{id}', [DoctorController::class,'reschedule'])->name('appointment.rescheudle.update');


Route::get('/doctor_form', [DepartmentController::class, 'index'])->middleware(['auth', 'verified'])->name('doctor.form');

Route::post('/doctor/save', [DoctorController::class,'save'])->name('doctor.save');

Route::get('/doctordashboard/edit/{id}', [DoctorController::class,'edit'])->name('doctorprofile.edit');
});

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
