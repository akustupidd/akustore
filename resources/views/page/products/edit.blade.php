@extends('layout.app')

@section('title', 'Update Product')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Products /</span> Update Product</h4>

    <form method="POST" class="form-group" action="{{ route('edit-data-product', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Update Product</h5>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <!-- Name -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" value="{{ $product->name }}" class="form-control" id="name" placeholder="Insert Name">
                            </div>

                            <!-- Price -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" name="price" value="{{ $product->price }}" class="form-control" id="price" placeholder="Insert Price">
                            </div>

                            <!-- Discount Price -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="discount_price" class="form-label">Discount Price</label>
                                <input type="number" name="discount_price" value="{{ $product->discount_price }}" class="form-control" id="discount_price" placeholder="Insert Discount Price" step="any">
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" id="quantity" placeholder="Insert Quantity">
                            </div>

                            <!-- Type -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="type" class="form-label">Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="">Choose Type</option>
                                    <option value="new product" {{ $product->type == 'new product' ? 'selected' : '' }}>New Product</option>
                                    <option value="feature" {{ $product->type == 'feature' ? 'selected' : '' }}>Feature</option>
                                    <option value="best deal" {{ $product->type == 'best deal' ? 'selected' : '' }}>Best Deal</option>
                                </select>
                            </div>

                            <!-- Category -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="category_id" class="form-label">Select Category</label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Brand -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="brand_id" class="form-label">Select Brand</label>
                                <select class="form-select" id="brand_id" name="brand_id">
                                    <option value="">Choose Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Type -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="product_type" class="form-label">Select Product Type</label>
                                <select class="form-select" id="product_type" name="product_type">
                                    <option value="">Choose Product Type</option>
                                    @foreach($products_type as $pt)
                                        <option value="{{ $pt->id }}" {{ $pt->id == $product->product_type ? 'selected' : '' }}>
                                            {{ $pt->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Accessory Type -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="accessary_id" class="form-label">Select Accessory Type</label>
                                <select class="form-select" id="accessary_id" name="accessary_id">
                                    <option value="">Choose Accessory Type</option>
                                    @foreach($accessaries as $accessary)
                                        <option value="{{ $accessary->id }}" {{ $accessary->id == $product->accessary_id ? 'selected' : '' }}>
                                            {{ $accessary->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Image -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="image" class="form-label">Product Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                @if($product->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="Current Image" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit / Cancel Buttons -->
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-danger" onclick="history.back(); return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
