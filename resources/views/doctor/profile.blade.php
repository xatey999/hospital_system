@extends('doctor.master')

@section('content')
                <!-- Content Area -->
                <div class="w-3/4 bg-white shadow-lg p-8 mx-auto rounded-xl">
                    @foreach ($doctor_Data as $doctor_Data)
                        <div class="doctor-profile mb-8 p-6 border border-gray-200 rounded-xl bg-gradient-to-r from-blue-50 to-white">
                            <h2 class="doctor-name text-3xl font-bold text-blue-800 mb-4">Name: {{ $doctor_Data->doctor_name }}</h2>
                            <p class="department-name text-xl text-gray-700 mb-2"><strong>Department:</strong> {{ $doctor_Data->department->name }}</p>
                            <p class="doctor-description text-lg text-gray-600 italic mb-4">
                                <strong>Description: </strong>{{ $doctor_Data->doctor_description }}
                            </p>
                            <p class="doctor-phone text-lg text-gray-700"><strong>Contact: </strong> {{ $doctor_Data->doctor_phone }}</p>
                        </div>
                    @endforeach
                    <div class="text-center mt-8">
                        <a href="{{ route('doctorprofile.edit', ['id' => auth()->id()]) }}">
                            <button type="button" class="bg-blue-600 text-white py-3 px-6 rounded-full shadow-md hover:bg-blue-700 transform hover:scale-105 transition-transform duration-300 focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-opacity-50">
                                Edit Profile
                            </button>
                        </a>
                    </div>
                </div>
                
@endsection
          

    

