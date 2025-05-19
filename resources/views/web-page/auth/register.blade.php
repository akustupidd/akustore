@extends('layout.app-auth')
@section('title', 'Register')
@section('content-auth')

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic py-5">
    <div class="authentication-inner mx-auto" style="max-width: 600px;">
      <div class="card shadow-sm border-0">
        <div class="card-body p-4">

          <!-- Brand Logo -->
          <div class="text-center mb-4">
            <a href="{{ route('home-page') }}">
              <img src="{{ asset('assets-web/images/dark 1.png') }}" width="150" alt="Brand Logo">
            </a>
          </div>

          <h4 class="mb-2 text-center">Create Your Account</h4>
          <p class="mb-4 text-center text-muted">Join us and make your shopping experience seamless!</p>

          <form method="POST" action="{{ route('customer.register.submit') }}" enctype="multipart/form-data">
            @csrf

            @if (session('success'))
              <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <div class="row g-3">

              <!-- Full Name -->
              <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
              </div>

              <!-- Email -->
              <div class="col-md-6">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
              </div>

              <!-- Password -->
              <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="password" class="form-control" required>
                  <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>

              <!-- Confirm Password -->
              <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                  <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                  <button type="button" class="btn btn-outline-secondary" id="toggleConfirmPassword">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>

              <!-- Country -->
              <div class="col-md-6">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-select">
                  <option value="Cambodia" {{ old('country') == 'Cambodia' ? 'selected' : '' }}>Cambodia (+855)</option>
                  <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand (+66)</option>
                  <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia (+62)</option>
                  <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States (+1)</option>
                </select>
              </div>

              <!-- Phone -->
              <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <div class="input-group">
                  <span class="input-group-text" id="countryCode">+855</span>
                  <input type="tel" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                </div>
              </div>

              <!-- Date of Birth -->
              <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" name="dob" id="dob" class="form-control" value="{{ old('dob') }}" required>
              </div>

              <!-- Gender -->
              <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select name="gender" id="gender" class="form-select" required>
                  <option disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                  <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                  <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                  <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
              </div>

              <!-- Address Line 1 -->
              <div class="col-md-6">
                <label for="address_line1" class="form-label">Address Line 1</label>
                <input type="text" name="address_line1" id="address_line1" class="form-control" value="{{ old('address_line1') }}" required>
              </div>

              <!-- Address Line 2 -->
              <div class="col-md-6">
                <label for="address_line2" class="form-label">Address Line 2 (optional)</label>
                <input type="text" name="address_line2" id="address_line2" class="form-control" value="{{ old('address_line2') }}">
              </div>

              <!-- City -->
              <div class="col-md-6">
                <label for="city" class="form-label">City</label>
                <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
              </div>

              <!-- State -->
              <div class="col-md-6">
                <label for="state" class="form-label">State (optional)</label>
                <input type="text" name="state" id="state" class="form-control" value="{{ old('state') }}">
              </div>

              <!-- Postal Code -->
              <div class="col-md-6">
                <label for="postal_code" class="form-label">Postal Code (optional)</label>
                <input type="text" name="postal_code" id="postal_code" class="form-control" value="{{ old('postal_code') }}">
              </div>

              <!-- Submit -->
              <div class="col-12">
                <button type="submit" class="btn btn-primary w-100 d-flex justify-content-center align-items-center" id="submitBtn">
                  <span id="btnText">Sign Up</span>
                  <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2" role="status" aria-hidden="true"></span>
                </button>
              </div>

            </div>
          </form>

          <p class="text-center mt-3 mb-0">
            Already have an account?
            <a href="{{ route('customer.login') }}">Sign in</a>
          </p>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
    // Show loading spinner on form submit
    const form = document.querySelector('form');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');

    form.addEventListener('submit', function () {
    submitBtn.disabled = true;
    btnText.textContent = 'Processing...';
    btnSpinner.classList.remove('d-none');
    });
  document.addEventListener('DOMContentLoaded', function () {
    // Country and phone code logic
    const apiUrl = 'https://ipinfo.io/json?token=19e0f77c0ad4f8';
    const countrySelect = document.getElementById('country');
    const countryCodeSpan = document.getElementById('countryCode');

    fetch(apiUrl)
      .then(response => response.json())
      .then(data => {
        const countryName = getCountryName(data.country);
        if (countryName) {
          countrySelect.value = countryName;
          countryCodeSpan.textContent = getCountryCode(data.country);
        }
      })
      .catch(console.error);

    countrySelect.addEventListener('change', function () {
      countryCodeSpan.textContent = getCountryCodeByName(this.value);
    });

    function getCountryName(code) {
      return { 'KH': 'Cambodia', 'TH': 'Thailand', 'ID': 'Indonesia', 'US': 'United States' }[code] || null;
    }

    function getCountryCode(code) {
      return { 'KH': '+855', 'TH': '+66', 'ID': '+62', 'US': '+1' }[code] || '';
    }

    function getCountryCodeByName(name) {
      return { 'Cambodia': '+855', 'Thailand': '+66', 'Indonesia': '+62', 'United States': '+1' }[name] || '';
    }

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');

    togglePassword.addEventListener('click', function () {
      const type = passwordInput.type === 'password' ? 'text' : 'password';
      passwordInput.type = type;
      this.querySelector('i').classList.toggle('bi-eye');
      this.querySelector('i').classList.toggle('bi-eye-slash');
    });

    const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
    const confirmPasswordInput = document.getElementById('password_confirmation');

    toggleConfirmPassword.addEventListener('click', function () {
      const type = confirmPasswordInput.type === 'password' ? 'text' : 'password';
      confirmPasswordInput.type = type;
      this.querySelector('i').classList.toggle('bi-eye');
      this.querySelector('i').classList.toggle('bi-eye-slash');
    });
  });
</script>

@endsection
