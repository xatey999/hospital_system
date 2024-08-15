<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
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
                        <h1 class="text-2xl font-bold">Doctor Dashboard</h1>
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
                            <a href="{{ route ('doctor.profile', ['id' => auth()->user()->id]) }}" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Profile</a>
                        </li>
                        <li>
                            <a href="" class="block py-2 px-4 text-gray-700 hover:bg-gray-200 rounded">Appointments</a>
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
                    <form method="POST" action="/doctordashboard/update/{{$doctor_Data->id}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                          <div class="col-6">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" placeholder="Doctor Name" id="doctor_name" name="doctor_name" value="{{ $doctor_Data->doctor_name }}" >
                          </div>
                          <div class="col-6">
                            <label for="description">Description:</label>
                            <input type="text" class="form-control" placeholder="Doctor Description" id="doctor_description" name="doctor_description" value="{{ $doctor_Data->doctor_description }}">
                          </div>
                          <div class="col-6">
                            <label for="phone">Contact Number:</label>
                            <input type="number" class="form-control" placeholder="Doctor Phone number" id="doctor_phone" name="doctor_phone" value="{{ $doctor_Data->doctor_phone }}">
                          </div>
                          <br>
                          <div class="col-6">
                            <br>
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>

                        </div>
                      </form>
                </div>
            </div>
        </div>
    </main>

    
</body>
</html>
