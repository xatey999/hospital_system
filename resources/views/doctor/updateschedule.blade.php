@extends('doctor.master')

@section('content')

<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6 mt-10">
    <form action="/schedules/update/{{$schedule->id}}" method="POST">
        @csrf
        <!-- Day Field -->
        <div class="mb-4">
            <label for="day" class="block text-sm font-medium text-gray-700">Select Day</label>
            <select id="day" name="day" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]">
                <option value="Sunday" {{ $schedule->day == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                <option value="Monday" {{ $schedule->day == 'Monday' ? 'selected' : '' }}>Monday</option>
                <option value="Tuesday" {{ $schedule->day == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                <option value="Wednesday" {{ $schedule->day == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                <option value="Thursday" {{ $schedule->day == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                <option value="Friday" {{ $schedule->day == 'Friday' ? 'selected' : '' }}>Friday</option>
                <option value="Saturday" {{ $schedule->day == 'Saturday' ? 'selected' : '' }}>Saturday</option>
            </select>
        </div>
        

        <!-- Start Time Field -->
        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" id="start_time" name="start_time" value="{{ \Carbon\Carbon::parse($schedule->start_time)->format('H:i') }}" required class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]" />
        </div>
        

        <!-- End Time Field -->
        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input type="time" id="end_time" name="end_time" value="{{ \Carbon\Carbon::parse($schedule->end_time)->format('H:i') }}" required class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm focus:ring-[#FF2D20] focus:border-[#FF2D20]" />
        </div>
        

        
        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-black font-semibold rounded-md hover:bg-blue-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                Update Schedule
            </button>
        </div>
        
        
    </form>
</div>

@endsection