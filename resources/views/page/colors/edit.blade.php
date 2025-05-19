@extends('layout.app')
@section('title') {{'Update Color'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Color/</span> Form Update Color</h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Update Color</h5>
            </div>
            <div class="card-body">
                <form method="post" class="form-group" action="{{ route('edit-data-color', $color->id)}}" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label" for="color_code">Color Code</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="text"
                                name="color_code"
                                class="form-control"
                                id="color_code"
                                placeholder="Insert color"
                                value="{{$color->color_code}}"
                            />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="color_name">Color Name</label>
                        <div class="input-group input-group-merge">
                            <input
                                type="text"
                                name="color_name"
                                class="form-control"
                                id="color_name"
                                placeholder="Insert color name"
                                value="{{$color->color_name}}"
                            />
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button class="btn btn-danger"  onclick="history.back(); return false;">Cancel</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection