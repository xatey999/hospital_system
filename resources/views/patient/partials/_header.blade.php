<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap link -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/darkly/bootstrap.min.css" rel="stylesheet"> --}}

    <style>
        /* Custom Styles for Sidebar */
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 1rem;
        }
        .nav-link:hover {
            background-color: #444 !important;
            border-radius: 5px;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .content {
            margin-top: 2rem;
        }
        /* Custom hover effect for sidebar links */
        .nav-link {
            transition: background-color 0.2s ease;
        }
    </style>
</head>
<body class="bg-gray-900 text-white">

<div class="flex">
    <!-- Sidebar -->
    <nav class="w-64 bg-gray-800 sidebar">
        <div class="flex flex-col p-4">
            <ul class="space-y-2">
                <li>
                    <a class="nav-link flex items-center px-4 py-2 text-lg font-semibold text-white hover:bg-gray-600 rounded-md" href="{{route('appointment.list')}}">
                        <i class="fa-solid fa-clipboard-list mr-2"></i> My Appointments
                    </a>
                </li>
                <li>
                    <a class="nav-link flex items-center px-4 py-2 text-lg font-semibold text-white hover:bg-gray-600 rounded-md" href="{{route('doctors.list')}}">
                        <i class="fa-solid fa-user-doctor mr-2"></i> Doctor's List
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main content -->
    <main class="flex-1 ml-64 p-6">
        <!-- Top Navigation -->
        <nav class="bg-gray-800 mb-4 p-4 rounded-md shadow-md">
            <div class="flex items-center justify-between">
                <a class="text-2xl font-bold text-white" href="{{route('dashboard')}}">Dashboard</a>
                <div class="flex space-x-4">
                    <a class="text-lg text-white hover:bg-gray-700 px-3 py-2 rounded-md" href="{{route('profile.edit')}}">
                        <i class="fas fa-user mr-2"></i> Profile
                    </a>
                    <a class="text-lg text-white hover:bg-gray-700 px-3 py-2 rounded-md" href="{{route('logout')}}">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </nav>
    </main>
</div>

<!-- Tailwind JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.js"></script>
</body>
</html>
