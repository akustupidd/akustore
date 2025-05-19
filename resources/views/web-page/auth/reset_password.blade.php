@extends('layout.app-auth')
@section('title') {{'Forgot Password'}} @endsection
@section('content-auth')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="{{ route('home-page') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('assets-web/images/dark 1.png') }}" width="150"/>
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Reset Your Password 🔒</h4>
                    <p class="mb-4">Enter the OTP and your new password to reset your account</p>

                    <!-- OTP Reset Password Form -->
                    <form method="POST" action="{{ route('customer.reset-password.submit') }}" class="mb-3">
                        @csrf

                        <!-- Success and Error Messages -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Hidden Email Field -->
                        <input type="hidden" name="email" value="{{ old('email', $email) }}">

                        <!-- OTP Input -->
                        <div class="mb-3">
                            <label for="OTP" class="form-label" id="timer">OTP</label>
                            <input 
                                type="text" 
                                name="otp" 
                                id="OTP" 
                                class="form-control" 
                                placeholder="Enter your 6-digit OTP" 
                                required
                                oninput="validateOTP()">
                        </div>


                        <!-- New Password Input -->
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">New Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input 
                                    id="password" 
                                    type="password" 
                                    class="form-control" 
                                    name="password" 
                                    placeholder="Enter your new password" 
                                    required>
                                <button 
                                    class="btn btn-outline-secondary" 
                                    type="button" 
                                    id="togglePasswordButton" 
                                    aria-label="Toggle password visibility" 
                                    data-bs-toggle="tooltip" 
                                    title="Show/Hide Password">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Confirm Password Input -->
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input 
                                    id="password_confirmation" 
                                    type="password" 
                                    class="form-control" 
                                    name="password_confirmation" 
                                    placeholder="Confirm your password" 
                                    required>
                                <button 
                                    class="btn btn-outline-secondary" 
                                    type="button" 
                                    id="togglePasswordButton" 
                                    aria-label="Toggle password visibility" 
                                    data-bs-toggle="tooltip" 
                                    title="Show/Hide Password">
                                    <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="btn btn-primary d-grid w-100" 
                            id="resetPasswordSubmit" 
                            disabled>
                            Reset Password
                        </button>
                    </form>

                    <!-- Resend Button -->
                    <form method="POST" action="{{ route('customer.resend-otp') }}" class="text-center mb-3">
                        @csrf
                        <input type="hidden" name="email" value="{{ old('email', $email) }}">
                        <button type="submit" class="btn btn-danger d-grid w-100">Resend OTP</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let timer = 180; // 3 minutes in seconds
    const timerElement = document.getElementById('timer');

    function updateTimer() {
        const minutes = Math.floor(timer / 60);
        const seconds = timer % 60;
        timerElement.textContent = `OTP expires in: ${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        if (timer > 0) {
            timer--;
        } else {
            timerElement.textContent = "OTP expired. Please request a new one.";
        }
    }

    setInterval(updateTimer, 1000); // Update every second
</script>
<script>
    const otpInput = document.getElementById('OTP');
    const resetButton = document.getElementById('resetPasswordSubmit');

    function validateOTP() {
        const otpValue = otpInput.value;
        if (/^[0-9]{6}$/.test(otpValue)) {
            resetButton.disabled = false; // Enable button if OTP is 6 digits
        } else {
            resetButton.disabled = true; // Disable button otherwise
        }
    }
</script>
@endsection
