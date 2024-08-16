@extends('doctor.master')

@section('content')

<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <form action="{{ route('schedules.store') }}" method="POST">
        @csrf
        <!-- Day Field -->
        <div class="mb-4">
            <label for="day" class="block text-sm font-medium text-gray-700">Select Day</label>
            <select id="day" name="day" required class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]">
                <option value="Sunday">Sunday</option>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
            </select>
        </div>

        <!-- Start Time Field -->
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" id="start_time" name="start_time" required class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]" />
        </div>

        <!-- End Time Field -->
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input type="time" id="end_time" name="end_time" required class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]" />
        </div>

        <!-- Doctor ID (Hidden) -->
        {{-- <input type="text" name="doctor_id" id="doctor_id" value="{{ auth()->user()->doctors->id }}"> --}}

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-black font-semibold rounded-md hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                Add Schedule
            </button>
        </div>
        
        
    </form>
</div>


@endsection