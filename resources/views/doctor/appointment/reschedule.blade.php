@extends('doctor.master')

@section('content')

<div class="max-w-lg mx-auto mt-10 p-6 bg-gray-100 shadow-md rounded-lg">
    <form action="/appointment/reschedule/{{$appointment_Data->id}}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-4">
            <label for="appointment_date" class="block text-gray-700 text-sm font-bold mb-2">
                Appointment Date
            </label>
            <input type="date" id="appointment_date" name="appointment_date" value="{{ old('appointment_date', $appointment_Data->appointment_date) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="mb-4">
            <label for="appointment_time" class="block text-gray-700 text-sm font-bold mb-2">
                Appointment Time
            </label>
            <input type="time" id="appointment_time" name="appointment_time" value="{{ old('appointment_time', $appointment_Data->appointment_time) }}" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" required>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                Update
            </button>
        </div>
    </form>
</div>

@endsection