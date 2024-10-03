<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patients;
use App\Models\Doctor;
use App\Models\Department;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    use AuthorizesRequests;
    public function index($id)
    {
        $doctor_Data = Doctor::with('schedules')->findOrFail($id);
        $patient = Patients::all();
        return view("appointment.appointment", compact('doctor_Data', 'patient'));
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $this->authorize('create', Appointment::class);

        $appointment = new Appointment();
        $appointment->fill($request->all());
        $appointment->patient_id = Auth::user()->patient->id;
        $appointment->save();
        return redirect()->route("doctors.list")->with("success", "Appointment Booked successfull!!");
    }

    public function list()
    {
        $appointment_Data = Appointment::query()->where('patient_id', '=', Auth::user()->patient->id)->with(['patient','doctors'])->get();
        // dd($appointment_Data);
        return view("appointment.myappointments", compact('appointment_Data'));
    }

    public function cancel($id)
    {
        $appointment_Data = Appointment::findOrFail($id);
        $appointment_Data->delete();
        return redirect()->route('appointment.list')->with('success', 'Appointment Cancelled Successfully!!');
    }
}
