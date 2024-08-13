<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientFormValidationRequest;
use App\Models\Patients;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(){
        return view('patientform');
    }

    public function save(PatientFormValidationRequest $request){
        
        $doctor_Data = new Patients();
        $doctor_Data->fill($request->all());
        $doctor_Data->save();
        return redirect()->route("dashboard")->with("success","Patient data saved successfully!");
    }
}
