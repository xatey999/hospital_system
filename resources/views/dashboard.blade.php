@extends('patient.master')

@section('content')

<!-- Main Content Area -->
<div class="flex flex-col items-center pt-6">
    <div class="text-center">
        <h1 class="text-white text-4xl">Welcome {{ Auth::user()->name }}</h1>
        <p class="text-white text-lg mt-4">Your information will be here.</p>
        <!-- Add your content here -->
    </div>
</div>

@endsection
