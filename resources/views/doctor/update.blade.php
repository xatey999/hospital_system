@extends('doctor.master')

@section('content')

                <!-- Content Area -->
                <div class="w-3/4 bg-white shadow-lg p-8 mx-auto rounded-xl">
                    <a href="{{ route('profile.edit') }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        Profile
                    </a> <br>
                    

                    <form method="POST" action="/doctordashboard/update/{{$doctor_Data->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            {{-- <div>
                                <label for="doctor_name" class="block text-lg font-medium text-gray-700 mb-2">Name:</label>
                                <input type="text" id="name" name="name" placeholder="Doctor Name" value="{{ $doctor_Data->user->name }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div> --}}
                            <div>
                                <label for="doctor_description" class="block text-lg font-medium text-gray-700 mb-2">Description:</label>
                                <input type="text" id="doctor_description" name="doctor_description" placeholder="Doctor Description" value="{{ $doctor_Data->doctor_description }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label for="doctor_phone" class="block text-lg font-medium text-gray-700 mb-2">Contact Number:</label>
                                <input type="number" id="doctor_phone" name="doctor_phone" placeholder="Doctor Phone number" value="{{ $doctor_Data->doctor_phone }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="sm:col-span-2 text-center">
                                <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-bold py-2 px-6 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-transform transform hover:scale-105">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                

    
@endsection
