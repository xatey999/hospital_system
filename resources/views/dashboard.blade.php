@extends('patient.master')

@section('content')

<!-- Main Content Area -->
<div class="flex items-center justify-center min-h-screen bg-gray-900">
    <div class="text-center">
        <h1 class="text-white text-4xl">Welcome {{ Auth::user()->name }}</h1>
        <p class="text-white text-lg mt-4">Your information will be here.</p>
        <!-- Add your content here -->
    </div>
</div>

@endsection
