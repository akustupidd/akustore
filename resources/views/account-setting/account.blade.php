@extends('layout.app')
@section('title') {{'Accouunt'}} @endsection
@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>
    <div class="row">
        <div class="col-md-12">
        
        <div class="card mb-4">
            <form id="formAccountSettings" method="post" action="{{ route('update-data-setting')}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img src="{{!is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->image) ? asset('uploads/users/' . Auth::guard('admin')->user()->image) : '../assets/img/avatars/1.png'  }}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" name="image"/>
                        <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                <span class="d-none d-sm-block">Upload new photo</span>
                                <i class="bx bx-upload d-block d-sm-none"></i>
                                <input type="file" id="upload" class="account-file-input" hidden accept="image/png, image/jpeg" name="image"/>
                            </label>
                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                        </div>
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input class="form-control" type="text" id="name" name="name" value="{{ !is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->name) ? Auth::guard('admin')->user()->name : 'Admin'}}" autofocus />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="{{ !is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->email) ? Auth::guard('admin')->user()->email : 'admin@admin.com'}}" placeholder="john.doe@example.com" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Username</label>
                            <input type="text" class="form-control" id="organization" name="username" value="{{ !is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->username) ? Auth::guard('admin')->user()->username : 'admin'}}" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Phone Number</label>
                            <div class="input-group input-group-merge">
                            <span class="input-group-text">KH (+855)</span>
                            <input type="number" id="phoneNumber" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ !is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->phone_number) ? Auth::guard('admin')->user()->phone_number : '+855 000-000-000'}}" />
                            </div>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{ !is_null(Auth::guard('admin')->user()) && isset(Auth::guard('admin')->user()->address) ? Auth::guard('admin')->user()->address : 'no address'}}"/>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                    </div>
                </div>
                <!-- /Account -->
            </form>

        </div>
        <div class="card">
            <h5 class="card-header">Delete Account</h5>
            <div class="card-body">
            <div class="mb-3 col-12 mb-0">
                <div class="alert alert-warning">
                <h6 class="alert-heading fw-bold mb-1">Are you sure you want to delete your account?</h6>
                <p class="mb-0">Once you delete your account, there is no going back. Please be certain.</p>
                </div>
            </div>
            <form id="formAccountDeactivation" onsubmit="return false">
                <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
                <label class="form-check-label" for="accountActivation">I confirm my account deactivation</label>
                </div>
                <a href="{{route('delete-account')}}" onclick="return confirmation(event)" type="submit" class="btn btn-danger deactivate-account">Deactivate Account</a>

            </form>
            </div>
        </div>
        </div>
    </div>
    </div>
    <!-- / Content -->
@endsection