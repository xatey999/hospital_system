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
                <label for="appointment_date" class="block text-sm font-medium text-gray-700">Appointment Date</label>
                <input id="appointment_date" type="date" name="appointment_date" class="form-control mt-1 block w-full text-black border border-gray-300 rounded-md py-2 px-3" value="{{ old('appointment_date') }}">
                @error('appointment_date')
                    <span class="error-message text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Schedules -->
            <div class="form-group mb-4">
                <label for="schedule" class="block text-sm font-medium text-gray-700">Available Schedules</label>
                <div id="schedule-list">
                    <p class="text-gray-500">Select a date to see available schedules.</p>
                </div>
                @error('day')
                    <span class="error-message text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- Appointment Time -->
            <div class="form-group mb-4">
                <input id="appointment_time" type="hidden" name="appointment_time" value="{{ old('appointment_time') }}">
            </div>

            <!-- Appointment Reason -->
            <div class="form-group mb-4">
                <label for="appointment_reason" class="block text-sm font-medium text-gray-700">Appointment Reason</label>
                <input id="appointment_reason" type="text" name="appointment_reason" class="form-control mt-1 block w-full text-black border border-gray-300 rounded-md py-2 px-3" placeholder="e.g., Regular checkup" value="{{ old('appointment_reason') }}">
                @error('appointment_reason')
                    <span class="error-message text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <!-- JavaScript to handle filtering and displaying schedules -->
            <script>
                document.getElementById('appointment_date').addEventListener('change', function() {
                    const selectedDate = new Date(this.value);
                    const selectedDay = selectedDate.toLocaleString('en-US', { weekday: 'long' });

                    const schedules = @json($doctor_Data->schedules); // Pass schedules data from Blade to JavaScript
                    
                    // Filter schedules by the selected day
                    const filteredSchedules = schedules.filter(schedule => schedule.day === selectedDay);

                    // Display filtered schedules
                    const scheduleList = document.getElementById('schedule-list');
                    scheduleList.innerHTML = ''; // Clear previous schedules

                    if (filteredSchedules.length > 0) {
                        filteredSchedules.forEach(schedule => {
                            const scheduleItem = document.createElement('button');
                            scheduleItem.type = 'button';
                            scheduleItem.className = 'schedule-item bg-gray-200 text-black border border-gray-300 rounded-md py-2 px-3 mb-2 w-full';
                            const startTime12 = formatTime24to12(schedule.start_time); // Convert start time to 12-hour format
                            const endTime12 = formatTime24to12(schedule.end_time);     // Convert end time to 12-hour format
                            scheduleItem.textContent = `${startTime12} - ${endTime12}`;
                            
                            // Add event listener to set the appointment_time value
                            scheduleItem.addEventListener('click', function() {
                                document.getElementById('appointment_time').value = schedule.start_time;
                                document.querySelectorAll('.schedule-item').forEach(item => item.classList.remove('bg-blue-200'));
                                scheduleItem.classList.add('bg-blue-200');
                            });

                            scheduleList.appendChild(scheduleItem);
                        });
                    } else {
                        scheduleList.innerHTML = '<p class="text-gray-500">No schedules available for the selected day.</p>';
                    }
                });

                // Function to convert 24-hour time to 12-hour time with AM/PM
                function formatTime24to12(time) {
                    let [hours, minutes] = time.split(':');
                    hours = parseInt(hours);
                    const period = hours >= 12 ? 'PM' : 'AM';
                    hours = hours % 12 || 12; // Convert to 12-hour format, 0 becomes 12
                    return `${hours}:${minutes} ${period}`;
                }
            </script>

            <!-- Submit Button -->
            <div class="form-group">
                <button type="submit" class="submit-button bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Book Appointment</button>
            </div>
        </form>
    </div>
</div>

@endsection
