@extends('doctor.master')

@section('content')

                <!-- Content Area -->
                <div class="w-3/4 bg-gradient-to-r from-blue-50 to-white shadow-lg p-6 mx-auto rounded-xl mt-8">
                    <h2 class="text-2xl font-bold text-blue-800 mb-4">
                        Welcome, Dr. {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-gray-700">
                        We're glad to have you here. Navigate through the dashboard to manage schedules and appointments.
                    </p>
                </div>
                
            

    
@endsection
