<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index(){
        $department = Department::all();
        return view("doctor.form",compact("department"));
    }
}
