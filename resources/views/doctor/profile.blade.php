<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-blue-600 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                </div>
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex-shrink-0">
                        <h1 class="text-2xl font-bold">Doctor Profile</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main content -->
    <main>
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-6">
            <div class="flex">
                <!-- Sidebar -->
                <nav class="w-1/4 bg-white shadow-md p-4">
                    <ul>
                        <li>
                            <a href="{{ route('doctor.profile', ['id' => auth()->user()->id]) }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('doctor.appointment.list') }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Appointments</a>
                        </li>
                        <li>
                            <a href="" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Schedules</a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full text-left py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Logout</button>
                            </form>
                        </li>
                    </ul>
                </nav>

                <!-- Content Area -->
                <div class="w-3/4 bg-white shadow-md p-4 ml-4">
                    <!-- Add your content here -->
                    {{-- <form class="" method="post" action="/doctordashboard/update/{id}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <style>
                                label {
                                    font-size: 1.1rem;
                                    font-weight: 600;
                                }
                            </style>
                            

                            <div class="position-relative form-group col-6">
                                <label for="title" class="">Doctor Name</label>
                                <input name="doctor_name" id="doctor_name" value="{{ $doctor_Data->doctor_name }}" placeholder="Doctor Name" type="text" class="form-control" value="{{ $doctor_Data->doctor_name }}" wfd-id="id4">
                            </div>

                            <div class="position-relative form-group col-6">
                                <label for="description" class="">Description</label>
                                <input name="doctor_description" id="doctor_description" value="{{$doctor_Data->doctor_description}}" placeholder="Doctor Description" type="text" class="form-control" value="{{ $doctor_Data->doctor_description }}" wfd-id="id4">
                            </div>

                            <div class="position-relative form-group col-6">
                                <label for="doctor_phone" class="">Doctor Phone</label>
                                <input name="doctor_phone" id="doctor_phone" value="{{$doctor_Data->doctor_phone}}" placeholder="Phone number" type="text" class="form-control" value="{{ $doctor_Data->doctor_phone }}" wfd-id="id4">
                            </div>

                            <div class="position-relative form-group col-6">
                                
                                <input name="department_id" type="text" id="department_id" value="{{$doctor_Data->department_id }}" type="text" class="form-control" value="{{ $doctor_Data->department_id }}" wfd-id="id4">
                            </div>

                        </div>
                        <button class="btn btn-primary col-4">Submit</button>
                    </form> --}}
                    
                    @foreach ($doctor_Data as $doctor_Data)
                        
                    
                    
                    <div class="doctor-profile">
                        <h2 class="doctor-name">Name: {{ $doctor_Data->doctor_name }}</h2>
                        <p class="department-name">Department: {{ $doctor_Data->department->name }}</p>
                        <p class="doctor-description">
                            Description: {{ $doctor_Data->doctor_description }}
                        </p>
                        <p class="doctor-phone">Phone: {{ $doctor_Data->doctor_phone }}</p>
                    </div>
                    @endforeach
                    <a href="{{ route ('doctorprofile.edit', ['id' => auth()->id()]) }}"
                    <button type="button" class="btn btn-primary">Edit</button>
                    </a>
                </div>
            </div>
        </div>
    </main>

    
</body>
</html>
