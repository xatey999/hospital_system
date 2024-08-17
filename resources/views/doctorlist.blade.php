@extends('patient.master')

@section('content')

<div class="bg-gray-900">
    <!-- Main Content Area -->
    <div class="flex flex-col items-center pt-6">
        <!-- Filter Form -->
        <form action="" method="GET" class="mb-6">
            <div class="flex items-center">
                <label for="department" class="text-white mr-4">Filter by Department:</label>
                <select id="department" name="department" class="bg-gray-800 text-white border border-gray-700 rounded-lg px-4 py-2">
                    <option value="">All Departments</option>
                    @foreach($doctor_Data->unique('department_id') as $doctor)
                        <option value="{{ $doctor->department->id }}" {{ request('department') == $doctor->department->id ? 'selected' : '' }}>
                            {{ $doctor->department->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="ml-4 btn btn-primary text-white">Filter</button>
            </div>
        </form>

        <div class="w-full lg:w-3/4 xl:w-2/3 p-6 bg-white shadow-md rounded-lg">
            <table class="min-w-full bg-white text-gray-800 shadow-md rounded-lg divide-y divide-gray-200">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Doctor Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Department</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($doctor_Data as $doctor)
                    <tr>
                        <th scope="row" class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loop->iteration }}</th>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->doctor_name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->department->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $doctor->doctor_description }}</td>
                        <td class="px-6 py-4 text-sm font-medium">
                            <a href="{{ route('appointment.form', ['id' => $doctor->id]) }}" class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                <i class="fa-solid fa-calendar-check mr-2"></i> Book Appointment
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        
    </div>
</div>

@endsection
