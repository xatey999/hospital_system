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

        <div class="w-full lg:w-3/4 xl:w-2/3 p-6">
            <table class="table-auto w-full bg-black text-white shadow-md rounded-lg">
                <thead>
                    <tr>
                        <th scope="col" class="px-4 py-2">#</th>
                        <th scope="col" class="px-4 py-2">Doctor Name</th>
                        <th scope="col" class="px-4 py-2">Department</th>
                        <th scope="col" class="px-4 py-2">Description</th>
                        <th scope="col" class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($doctor_Data as $doctor)
                    <tr class="border-b border-gray-700">
                        <th scope="row" class="px-4 py-2">{{ $loop->iteration }}</th>
                        <td class="px-4 py-2">{{ $doctor->doctor_name }}</td>
                        <td class="px-4 py-2">{{ $doctor->department->name }}</td>
                        <td class="px-4 py-2">{{ $doctor->doctor_description }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('appointment.form', ['id' => $doctor->id]) }}" class="btn btn-primary text-white text-lg inline-flex items-center">
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
