@extends('patient.master')

@section('content')

<!-- Main Content Area -->
<div class="doctor-form-container flex justify-center">
    <div class="form-inner-container w-full max-w-md">
        <h2 class="form-title text-center text-2xl font-bold mb-4">Appointment Information</h2>

        <form method="POST" action="/appointment/form/save" class="bg-white p-6 rounded-lg shadow-md">
            @csrf

            <!-- For doctor id -->
            <div class="form-group mb-4">
                <input id="doctor_id" name="doctor_id" type="hidden" class="form-control" value="{{ $doctor_Data->id }}">
            </div>

            <!-- Appointment Date -->
            <div class="form-group mb-4">
                <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date and Time</label>
                <input id="appointment_date" type="datetime-local" name="appointment_date" class="form-control mt-1 block w-full text-black border border-gray-300 rounded-md py-2 px-3" value="{{ old('appointment_date') }}">
                @error('appointment_date')
                    <span class="error-message text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Appointment Reason -->
            <div class="form-group mb-4">
                <label for="appointment_reason" class="block text-sm font-medium text-gray-700">Appointment Reason</label>
                <input id="appointment_reason" type="text" name="appointment_reason" class="form-control mt-1 block w-full text-black border border-gray-300 rounded-md py-2 px-3" placeholder="e.g., Regular checkup" value="{{ old('appointment_reason') }}">
                @error('appointment_reason')
                    <span class="error-message text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="submit-button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Book Appointment</button>
            </div>
        </form>
    </div>
</div>

@endsection
