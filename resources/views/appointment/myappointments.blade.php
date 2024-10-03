@extends('patient.master')

@section('content')

<div class="flex flex-col items-center pt-6">
    <!-- Main Content Area -->
    <h2 class="text-2xl font-bold mb-4">Your Appointments</h2>
    <div class="w-full max-w-4xl bg-white p-6 rounded-lg shadow-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100 text-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">SN</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Doctor Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Appointment Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Appointment Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Appointment Cause</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($appointment_Data as $appointment_Data)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $appointment_Data->doctors->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment_Data->appointment_date)->format('l, F j') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ \Carbon\Carbon::parse($appointment_Data->appointment_time)->format('g:i A') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $appointment_Data->appointment_reason }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('appointment.cancel', ['id' => $appointment_Data->id]) }}" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to cancel this?');">
                                <i class="fa-regular fa-rectangle-xmark"></i> Cancel Appointment
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-600">No appointments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
