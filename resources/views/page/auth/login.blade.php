@extends('layout.app-auth')
@section('title') {{'Login'}} @endsection
@section('content-auth')
   <!-- Content -->
   <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="#" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{asset('assets-web/images/dark 1.png')}}" width="150"/>
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Welcome to Login! 👋</h4>
                        <p class="mb-4">Please sign-in to your account and start the adventure</p>
                        <form  method="POST" action="{{ route('admin.login') }}" id="formAuthentication" class="mb-3">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" 
                                class="form-control"  
                                name="email"
                                placeholder="Enter your email address"
                                />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}">Forgot Your Password</a>
                                    @endif
                                </div>
                                <div class="input-group input-group-merge">
                                    <input 
                                        id="password" 
                                        type="password" 
                                        class="form-control" 
                                        name="password" 
                                        placeholder="Enter your password">
                                    <button 
                                        class="btn btn-outline-secondary" 
                                        type="button" 
                                        id="togglePasswordButton" 
                                        aria-label="Toggle password visibility" 
                                        data-bs-toggle="tooltip" 
                                        title="Show/Hide Password">
                                        <i class="bi bi-eye" id="togglePasswordIcon"></i>
                                    </button>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
