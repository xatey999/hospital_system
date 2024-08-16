@extends('doctor.master')

@section('content')
<!-- Main Content Area -->
<div class="w-3/4 bg-white shadow-lg p-8 mx-auto rounded-xl">
    <!-- Add Schedule Button -->
    <div class="mb-6 text-left">
        <a
            href="{{ route('schedules.create') }}"
            class="inline-block rounded-md bg-blue-600 px-6 py-3 text-white font-semibold transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-lg"
        >
            Add Schedule
        </a>
    </div>
    

    @foreach ($schedules as $schedules)
        
    
    <!-- Doctor's Schedules -->
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
        <!-- Schedule Card 1 -->
        <div class="max-w-sm rounded overflow-hidden shadow-lg bg-gray-100">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{ $schedules->day }}</div>
                <p class="text-gray-700 text-base">
                    Start Time: {{ \Carbon\Carbon::parse($schedules->start_time)->format('g:i A') }}
                </p>
                <p class="text-gray-700 text-base">
                    End Time: {{ \Carbon\Carbon::parse($schedules->end_time)->format('g:i A') }}
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>





@endsection