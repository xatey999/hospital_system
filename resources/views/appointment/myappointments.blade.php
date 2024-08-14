<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom Dark Theme CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.0/dist/darkly/bootstrap.min.css" rel="stylesheet">
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
<body class="bg-dark text-white">

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 bg-dark sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="{{route('dashboard')}}">
                            <i class="fas fa-tachometer-alt"></i> My Appointments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{route('doctors.list')}}">
                            <i class="fas fa-box"></i>Doctor's List
                        </a>
                    </li>
                    
                    
                    
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <!-- Top Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('dashboard')}}">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('profile.edit')}}"><i class="fas fa-user"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav> 
            
            <!-- Main Content Area -->
            <h2>Your Appointments</h2>
<table class="table">
    <thead>
        <tr>
            <th>SN</th>
            <th>Doctor</th>
            <th>Appointment Date</th>
            <th>Appointment Cause</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($appointment_Data as $appointment_Data)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $appointment_Data->patient_id }}</td>
                {{-- <td>{{ $appointment_Data->doctors->doctor_name }}</td> --}}
                <td>{{ $appointment_Data->appointment_date }}</td>
                <td>{{ $appointment_Data->appointment_reason }}</td>
                <td><a href="{{ route('appointment.cancel',['id'=>$appointment_Data->id]) }}" class="btn btn-danger btn-lg show_confirm " onclick="return confirm('Are you sure you want to delete this?');" style="font-size: 1.1rem;">
                    <i class="fa-regular fa-rectangle-xmark"></i>  Cancel Appointment</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4">No appointments found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
            
            <!-- Embedded CSS -->
            <style>
                /* Container */
                .doctor-form-container {
                    max-width: 600px;
                    margin: 50px auto;
                    padding: 20px;
                    background-color: #f9f9f9;
                    border-radius: 10px;
                    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                }
            
                /* Form Title */
                .form-title {
                    text-align: center;
                    font-size: 24px;
                    margin-bottom: 20px;
                    color: #333;
                }
            
                /* Form Group */
                .form-group {
                    margin-bottom: 15px;
                }
            
                /* Labels */
                .form-group label {
                    display: block;
                    font-weight: bold;
                    margin-bottom: 5px;
                    color: #555;
                }
            
                /* Inputs and Textareas */
                .form-control {
                    width: 100%;
                    padding: 10px;
                    font-size: 16px;
                    border: 1px solid #ccc;
                    border-radius: 5px;
                    background-color: #fff;
                }
            
                /* Textarea */
                textarea.form-control {
                    resize: vertical;
                    min-height: 100px;
                }
            
                /* Submit Button */
                .submit-button {
                    display: block;
                    width: 100%;
                    padding: 10px;
                    font-size: 18px;
                    color: #fff;
                    background-color: #007bff;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s ease;
                }
            
                /* Submit Button Hover */
                .submit-button:hover {
                    background-color: #0056b3;
                }
            
                /* Error Message */
                .error-message {
                    color: #e74c3c;
                    font-size: 14px;
                    margin-top: 5px;
                }
            </style>
        </main>
    </div>
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
