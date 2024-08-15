<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    
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
                <div class="w-3/4 bg-dark shadow-md p-8 ml-10">
                    <!-- Add your content here -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-800 text-white border border-gray-700 rounded-lg">
                            <thead class="bg-gray-700">
                               
                                <tr>
                                    <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">SN</th>
                                    <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">Patient Name</th>
                                    <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">Patient's Address</th>
                                    <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">Appointment Date</th>
                                    <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">Appointment Reason</th>
                                    {{-- <th scope="col" class="py-3 px-6 text-left border-b border-gray-600">Handle</th> --}}
                                </tr>
                            </thead>
                            @foreach($appointment_Data as $appointment_Data)
                            <tbody>
                                <tr class="bg-gray-800 hover:bg-gray-700">
                                    <th scope="row" class="py-4 px-6 border-b border-gray-600">{{ $loop->iteration }}</th>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->patient->user->name }}</td>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->patient->address }}</td>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->appointment_date }}</td>
                                    <td class="py-4 px-6 border-b border-gray-600">{{ $appointment_Data->appointment_reason }}</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    
</body>
</html>
