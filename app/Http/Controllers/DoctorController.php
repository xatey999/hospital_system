<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidationRequest;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Auth;

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
        // dd($doctor_Data);
        return view('doctor.profile', compact('doctor_Data'));
    }

    public function edit($id){
        $doctor_Data = Doctor::where('user_id', '=', $id)->first();
        // dd($doctor_Data);
        return view('doctor.update', compact('doctor_Data'));
    }

    public function update(Request $request, $id){
        $doctor_Data = Doctor::find($id);
        if (!$doctor_Data) {
            return redirect()->route("doctor.profile")->with("error", "Doctor not found.");
        }
        $doctor_Data-> doctor_name = $request->input('doctor_name');
        $doctor_Data-> doctor_description = $request->input('doctor_description');
        $doctor_Data-> doctor_phone = $request->input('doctor_phone');
        // dd($doctor_Data);
        // $doctor_Data->department_id = $request->department_id;
        // $doctor_Data->user_id = $request->user_id;
        $doctor_Data->save();
        return redirect()->route("doctor.dashboard")->with("success","Doctor data updated successfully!");
    }
}
