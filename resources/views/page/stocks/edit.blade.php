@extends('layout.app')
@section('title') {{'Update Stock'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Stock/</span> Form @yield('title')</h4>
    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">@yield('title')</h5>
            </div>
            <div class="card-body">
                <form method ="post" class="form-group" action="{{ route('update-data-stock' ,$stock->id)}}" enctype="multipart/form-data">
                    @csrf  
                    @method('PUT')
                    <div class="row">
                        <div class="mb-3 col-12 col-lg-6">
                            <label for="product_id" class="form-label">Select Product <span class="text-danger">*</span></label>
                            <select class="form-select" id="product_id" name="product_id" required disabled>
                                <option value="">Chosse Product</option>
                                @foreach($products as $item)
                                <option value="{{$item->id}}" {{$item->id == $stock->product_id ? 'selected' : '' }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="number"
                                    name="quantity"
                                    class="form-control"
                                    id="quantity"
                                    placeholder="Insert quantity"
                                    aria-label="Insert quantity"
                                    value="{{$stock->quantity}}"
                                    required
                                />
                            </div>
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="number"
                                    name="price"
                                    class="form-control"
                                    id="price"
                                    placeholder="Insert Price"
                                    aria-label="Insert Price"
                                    value="{{$stock->price}}"
                                    required
                                />
                            </div>
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 col-lg-6">
                            <label class="form-label" for="name">Sku</label>
                            <div class="input-group input-group-merge">
                                <input
                                    type="text"
                                    name="sku"
                                    class="form-control"
                                    id="sku"
                                    value="{{$stock->sku}}"
                                    placeholder="SKU Auto Generate"
                                    disabled
                                />
                            </div>
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