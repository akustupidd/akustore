@extends('layout.app')
@section('title') {{'User Insert'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Users/</span> Form Insert User</h4>
    <!-- Basic Layout -->
    <form method="post" class="form-group" action="{{route('insert-data-user')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Insert User</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="name">Name</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        id="name"
                                        placeholder="Insert name"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="username">Username</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="username"
                                        class="form-control"
                                        id="username"
                                        placeholder="Insert username"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="image">Image</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                        id="image"
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="name">Email</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="email"
                                        class="form-control"
                                        id="email"
                                        placeholder="Insert email"
                                        required
                                    />
                                </div>
                            </div> 
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="name">Password</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="pass"
                                        name="password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Insert password"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="phone_number">Phone Number</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="number"
                                        name="phone_number"
                                        class="form-control"
                                        id="phone_number"
                                        placeholder="Insert phone number"
                                        required
                                    />
                                </div>
                            </div>
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="address">Address</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="address"
                                        class="form-control"
                                        id="address"
                                        placeholder="Insert address"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Assign Role</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="role_id" class="form-label">Role <span class="text-danger">*</span></label>
                                    <select class="form-select" id="role_id" name="role_id" required>
                                        <option value="">Select Roles</option>
                                        @if ($roles->isNotEmpty())
                                        @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button class="btn btn-danger"  onclick="history.back(); return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection