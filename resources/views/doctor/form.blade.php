
<div class="doctor-form-container">
    <h2 class="form-title">Doctor Information</h2>

    <form method="POST" action="/doctor/save">
        @csrf

        <!-- Doctor Name -->
        {{-- <div class="form-group">
            <label for="name">Doctor Name</label>
            <input id="doctor_name" type="text" name="doctor_name" class="form-control" value="{{ old('name') }}" >
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div> --}}

        <!-- Doctor Description -->
        <div class="form-group">
            <label for="description">Doctor Description</label>
            <textarea id="doctor_description" name="doctor_description" class="form-control" >{{ old('description') }}</textarea>
            @error('description')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Doctor Phone Number -->
        <div class="form-group">
            <label for="phone">Doctor Phone Number</label>
            <input id="doctor_phone" type="text" name="doctor_phone" class="form-control" value="{{ old('phone') }}" >
            @error('phone')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Department Selection -->
<div class="form-group">
    <label for="department">Department</label>
    <select id="department_id" name="department_id" class="form-control" >
        <option value="">Select Department</option>
        @foreach($department as $department)
            <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>
                {{ $department->name }}
            </option>
        @endforeach
    </select>
    @error('department')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

    <!-- For user_id -->
    <div class="form-group">
        <input id="user_id" name="user_id" type="hidden" class="form-control"  value="{{auth()->user()->id}}" 


        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="submit-button">Save Doctor Information</button>
        </div>
    </form>
</div>

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

