
<div class="doctor-form-container">
    <h2 class="form-title">Patient Information</h2>

    <form method="POST" action="/patient/save">
        @csrf

        <!-- Doctor Name -->
        <div class="form-group">
            <label for="name">Date Of Birth </label>
            <input id="date_of_birth" type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" >
            @error('name')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Patient gender -->
        <div class="form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" class="form-control">
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
            </select>
            @error('gender')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="phone">Address</label>
            <input id="address" type="text" name="address" class="form-control" value="{{ old('address') }}" >
            @error('address')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

    <!-- For user_id -->
    <div class="form-group">
        <input id="user_id" name="user_id" type="hidden" class="form-control"  value="{{auth()->user()->id}}" 


        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="submit-button">Save Patient's Information</button>
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

