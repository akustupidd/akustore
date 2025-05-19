@extends('layout.app')
@section('title') {{'Update Client'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Color/</span> Form Update User</h4>
    <!-- Basic Layout -->
    <form method="post" class="form-group" action="{{ route('client.edit', $customer->id)}}" enctype="multipart/form-data">
        @csrf  
        @method('PUT')
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update User</h5>
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
                                        value="{{$customer->name}}"
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
                                        value="{{$customer->username}}"
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
                                        value="{{$customer->image}}"    
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
                                        value="{{$customer->email}}"
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
                                        value="{{$customer->password}}"
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
                                         value="{{$customer->phone_number}}"
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
                                         value="{{$customer->address}}"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card mb-4">
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
                                    <option value="{{$role->id}}" {{$role->id == $customer->role_id ? 'selected' : '' }}>{{$role->name}}</option>
                                    @endforeach
                                @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card mb-4">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class="btn btn-danger"  onclick="history.back(); return false;">Cancel</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection