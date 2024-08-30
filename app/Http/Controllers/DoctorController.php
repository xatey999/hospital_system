<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function save(ValidationRequest $request){
        
        $doctor_Data = new Doctor();
        $doctor_Data->fill($request->all());
        $doctor_Data->save();
        return redirect()->route("doctor.dashboard")->with("success","Doctor data saved successfully!");
    }

    public function profile($id)
    {
        $loginId = Auth::user()->id;
        $doctor_Data = Doctor::where('user_id', '=', $loginId)->get();
        return view('doctor.profile', compact('doctor_Data'));
    }

    public function edit($id){
        $doctor_Data = Doctor::where('user_id', '=', $id)->with('user')->first();
        return view('doctor.update', compact('doctor_Data'));
    }

    public function update(Request $request, $id){
        $doctor_Data = Doctor::find($id);
        if (!$doctor_Data) {
            return redirect()->route("doctor.profile")->with("error", "Doctor not found.");
        }
        
        // $doctor_Data-> doctor_name = $request->input('doctor_name');
        $doctor_Data-> doctor_description = $request->input('doctor_description');
        $doctor_Data-> doctor_phone = $request->input('doctor_phone');
        $doctor_Data->save();
        return redirect()->route("doctor.dashboard")->with("success","Doctor data updated successfully!");
    }

    public function appointment(){
        $appointment_Data =  Appointment::query()->where('doctor_id', '=', Auth::user()->doctor->id)->with(['patient'])->get();
        return view('doctor.appointments', compact('appointment_Data'));
    }

    public function reschedulePage($id){
        $appointment_Data = Appointment::find($id);
        return view('doctor.appointment.reschedule', compact('appointment_Data'));
    }

    public function reschedule(Request $request, $id){
        $appointment_Data = Appointment::find($id);
        $appointment_Data-> appointment_date = $request->input('appointment_date');
        $appointment_Data-> appointment_time = $request->input('appointment_time');
        $appointment_Data->save();
        return redirect()->route('doctor.appointment.list')->with('success', 'Appointment rescheduled successfully!!');
    }
}
