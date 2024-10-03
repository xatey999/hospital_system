@extends('doctor.master')

@section('content')

                <!-- Content Area -->
                <div class="w-3/4 bg-gray-900 shadow-lg p-8 mx-auto rounded-xl mt-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-800 text-white rounded-lg overflow-hidden">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">SN</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Patient Name</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Patient's Address</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Appointment Date</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Appointment Time</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Appointment Reason</th>
                                    <th scope="col" class="py-3 px-6 text-left font-semibold uppercase tracking-wider border-b border-gray-600">Action</th>
                                </tr>
                            </thead>
                            @foreach($appointment_Data as $appointment_Data)
                            <tbody>
                                <tr class="bg-gray-800 hover:bg-gray-700 transition-colors duration-200">
                                    <th scope="row" class="py-4 px-6 border-b border-gray-600">{{ $loop->iteration }}</th>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->patient->user->name }}</td>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->patient->address }}</td>
                                    <td class="py-4 px-6 border-b border-gray-600">
                                        {{ \Carbon\Carbon::parse($appointment_Data->appointment_date)->format('l, F j') }}
                                    </td>
                                    <td class="py-4 px-6 border-b border-gray-600">
                                        {{ \Carbon\Carbon::parse($appointment_Data->appointment_time)->format('g:i A') }}
                                    </td>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->appointment_reason }}</td>
                                    <td>
                                    <a href="{{ route('appointment.reschedule',['id'=> $appointment_Data->id]) }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition duration-300 ease-in-out">
                                        Reschedule
                                    </a>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                

    
@endsection
