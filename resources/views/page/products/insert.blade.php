@extends('layout.app')

@section('title') {{ 'Insert New Product' }} @endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Products /</span> Form @yield('title')
    </h4>

    <form method="post" action="insert-data-product" class="form-group" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">@yield('title')</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Product Name -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Insert Name" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                                <input type="number" name="price" class="form-control" id="price" placeholder="Insert Price" step="any">
                                @error('price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Discount Price -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label class="form-label" for="discount_price">Price Discount</label>
                                <input type="number" name="discount_price" class="form-control" id="discount_price" placeholder="Insert Discount Price" step="any">
                                @error('discount_price') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Insert quantity">
                                @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Type -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="type" class="form-label">Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="type" name="type">
                                    <option value="">Choose Type</option>
                                    <option value="new product">New Product</option>
                                    <option value="feature">Feature</option>
                                    <option value="best deal">Best Deal</option>
                                </select>
                                @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Category -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="category_id" class="form-label">Select Category <span class="text-danger">*</span></label>
                                <select class="form-select" id="category_id" name="category_id">
                                    <option value="">Choose Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Brand -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="brand_id" class="form-label">Select Brand <span class="text-danger">*</span></label>
                                <select class="form-select" id="brand_id" name="brand_id">
                                    <option value="">Choose Brand</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Product Type -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="product_type" class="form-label">Select Product Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="product_type" name="product_type">
                                    <option value="">Choose Product Type</option>
                                    @foreach($products_type as $product_type)
                                        <option value="{{ $product_type->id }}">{{ $product_type->name }}</option>
                                    @endforeach
                                </select>
                                @error('product_type') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Accessary -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="accessary_id" class="form-label">Select Accessory Type <span class="text-danger">*</span></label>
                                <select class="form-select" id="accessary_id" name="accessary_id">
                                    <option value="">Choose Accessory Type</option>
                                    @foreach($accessaries as $accessary)
                                        <option value="{{ $accessary->id }}">{{ $accessary->name }}</option>
                                    @endforeach
                                </select>
                                @error('accessary_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <!-- Image -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label class="form-label" for="image">Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control" id="image">
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnail -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header"><h5>Thumbnail</h5></div>
                    <div class="card-body">
                        <label class="form-label" for="thumbnails">Thumbnail Images</label>
                        <input type="file" name="thumbnails[]" class="form-control" id="thumbnails" multiple>
                    </div>
                </div>
            </div>

            <!-- Colors -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header"><h5>Colors</h5></div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($colors as $color)
                                <div class="col-3 d-flex align-items-center">
                                    <input type="checkbox" id="color-{{ $color->id }}" name="colors[]" value="{{ $color->id }}">
                                    <label for="color-{{ $color->id }}" class="ms-2">
                                        <span class="colors-check" style="background-color: {{ $color->color_code }}; display:inline-block; width:20px; height:20px; border-radius:50%;"></span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rams -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header"><h5>Rams</h5></div>
                    <div class="card-body">
                        @foreach ($rams as $ram)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ram-{{ $ram->id }}" name="rams[]" value="{{ $ram->id }}">
                                <label class="form-check-label" for="ram-{{ $ram->id }}">{{ $ram->size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Storages -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header"><h5>Storages</h5></div>
                    <div class="card-body">
                        @foreach ($storages as $storage)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="storage-{{ $storage->id }}" name="storages[]" value="{{ $storage->id }}">
                                <label class="form-check-label" for="storage-{{ $storage->id }}">{{ $storage->size }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Add Info Product (Soft Info and Specification) -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Soft Info</h5>
                        <button id="addInputBtn" type="button" class="btn btn-sm btn-primary">Add Input</button>
                    </div>
                    <div class="card-body" id="inputContainer"></div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Specification</h5>
                        <button id="addInputBtn2" type="button" class="btn btn-sm btn-primary">Add Input</button>
                    </div>
                    <div class="card-body" id="inputContainer2"></div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body text-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <button class="btn btn-danger" onclick="history.back(); return false;">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- JS Handlers -->
<script>
    $(document).ready(function() {
        $('#addInputBtn').click(function() {
            const input = `
                <div class="row form-group-soft-info border p-2 position-relative mb-3">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2"></button>
                    <div class="col-lg-6 mb-2">
                        <label>Image</label>
                        <input type="file" name="soft_info_image[]" class="form-control" />
                    </div>
                    <div class="col-lg-6 mb-2">
                        <label>Level</label>
                        <input type="text" name="soft_info_level[]" class="form-control" />
                    </div>
                    <div class="col-lg-12">
                        <label>Description</label>
                        <input type="text" name="soft_info_description[]" class="form-control" />
                    </div>
                </div>`;
            $('#inputContainer').append(input);
        });

        $('#inputContainer').on('click', '.btn-close', function() {
            $(this).closest('.form-group-soft-info').remove();
        });

        $('#addInputBtn2').click(function() {
            const input = `
                <div class="row form-group-soft-info border p-2 position-relative mb-3">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-2"></button>
                    <div class="col-lg-12 mb-2">
                        <label>Title</label>
                        <input type="text" name="spec_title[]" class="form-control" />
                    </div>
                    <div class="col-lg-12">
                        <label>Description</label>
                        <textarea name="spec_description[]" class="form-control" rows="3"></textarea>
                    </div>
                </div>`;
            $('#inputContainer2').append(input);
        });

        $('#inputContainer2').on('click', '.btn-close', function() {
            $(this).closest('.form-group-soft-info').remove();
        });
    });
</script>
@endsection
