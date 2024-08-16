<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::all();
        return view("doctor.schedules", compact("schedules"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("doctor.addschedule");
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $schedule = new Schedule();
        $schedule->doctor_id = auth()->user()->doctors->id;
        $schedule->fill($request->all());
        $schedule->save();
        return redirect()->route("schedules.index")->with("success","New schedule added!!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $schedule = Schedule::find($id);
        return view("doctor.updateschedule", compact("schedule"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::find($id);
        $schedule-> day = $request->input('day');
        $schedule-> start_time = $request->input('start_time');
        $schedule-> end_time = $request->input('end_time');
        $schedule->save();
        return redirect()->route("schedules.index")->with("success","Schedule updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route("schedules.index")->with("success","Schedule deleted successfully!!");
    }
}
