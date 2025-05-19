@extends('layout.app-auth')
@section('title') {{ __('Forgot Password') }} @endsection
@section('content-auth')
<!-- Content -->
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner py-4">
      <!-- Forgot Password -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{ route('home-page') }}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                <img src="{{asset('assets-web/images/dark 1.png')}}" width="150"/>
                </span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">{{ __('Forgot Password? 🔒') }}</h4>
          <p class="mb-4">{{ __("Enter your email and we'll send you instructions to reset your password") }}</p>

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

          <form id="formAuthentication" class="mb-3" action="{{ route('customer.send-otp') }}" method="POST" onsubmit="handleFormSubmit(event)">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">{{ __('Email') }}</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('Enter your email') }}" autofocus required/>
            </div>
            <button class="btn btn-primary d-grid w-100" type="submit" id="submitButton">
              <span id="buttonText">{{ __('Send Reset Link') }}</span>
              <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            </button>
          </form>

          <div class="text-center">
            <a href="{{ route('customer.login') }}" class="d-flex align-items-center justify-content-center">
              <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i> {{ __('Back to login') }}
            </a>
          </div>
        </div>
      </div>
      <!-- /Forgot Password -->
    </div>
  </div>
</div>

<script>
    function handleFormSubmit(event) {
      const submitButton = document.getElementById('submitButton');
      const buttonText = document.getElementById('buttonText');
      const loadingSpinner = document.getElementById('loadingSpinner');
  
      // Disable the button to prevent multiple submissions
      submitButton.disabled = true;
  
      // Show the loading spinner and hide the text
      loadingSpinner.classList.remove('d-none');
      buttonText.classList.add('d-none');
    }
  </script>
<!-- / Content -->
@endsection
