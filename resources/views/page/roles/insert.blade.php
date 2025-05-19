@extends('layout.app')
@section('title') {{'Insert Role'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">@yield('title')/</span> Form Insert @yield('title')</h4>
    <!-- Basic Layout -->
    <form method="post" class="form-group" action="{{route('insert-data-role')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <label class="form-label" for="name">Name</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        id="name"
                                        placeholder="Insert Name"
                                        required
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Assign Permission</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-lg-12">
                                <div class="d-flex align-items-center">
                                    @if ($permissions->isNotEmpty())
                                        @foreach ($permissions as $permission )
                                            <div class="form-group d-flex align-items-center" style="margin-right: 10px;">
                                                <input 
                                                id="permission-{{$permission->id}}" 
                                                type="checkbox" 
                                                class="mr-5 rounded"
                                                name="permission[]"  
                                                value="{{$permission->id}}"
                                                style="margin-right: 5px;"
                                                > 
                                                <label class="form-label" for="permission-{{$permission->id}}" style="margin: 0;">{{$permission->name}}</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
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