@extends('layout.app')
@section('title') Insert Stock @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">@yield('title') /</span> Form @yield('title')
    </h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">@yield('title')</h5>
                </div>
                <div class="card-body">
                    <form method="post" class="form-group" action="{{ route('insert-data-stock') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Select Product -->
                            <div class="mb-3 col-12 col-lg-6">
                                <label for="product_id" class="form-label">Select Product <span class="text-danger">*</span></label>
                                <select class="form-select form-control" id="product_id" name="product_id" onchange="loadStockData()" required>
                                    <option value="">Choose Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        data-quantity="{{ $product->stock->quantity ?? 'Out of Stock' }}"
                                        data-price="{{ $product->stock->price ?? 'Out of Stock' }}"
                                        data-sku="{{ $product->stock->sku ?? 'Out of Stock' }}">
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Quantity -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="quantity"
                                    class="form-control"
                                    id="quantity"
                                    placeholder="Out of Stock"
                                    
                                />
                                @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="price">Price <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="price"
                                    class="form-control"
                                    id="price"
                                    placeholder="Out of Stock"
                                    
                                />
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- SKU -->
                            <div class="mb-3 col-lg-6">
                                <label class="form-label" for="sku">Sku</label>
                                <div class="input-group input-group-merge">
                                    <input
                                        type="text"
                                        name="sku"
                                        class="form-control"
                                        id="sku"
                                        placeholder="Out of Stock"
                                        readonly
                                    />
                                </div>
                            </div>                            
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button class="btn btn-danger" onclick="history.back(); return false;">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadStockData() {
        const selectedOption = document.querySelector('#product_id option:checked');
        const quantity = selectedOption.getAttribute('data-quantity');
        const price = selectedOption.getAttribute('data-price');
        const sku = selectedOption.getAttribute('data-sku');

        // Update fields with stock data or show "Out of Stock"
        document.getElementById('quantity').value = quantity !== 'Out of Stock' ? quantity : 'Out of Stock';
        document.getElementById('price').value = price !== 'Out of Stock' ? price : 'Out of Stock';
        document.getElementById('sku').value = sku !== 'Out of Stock' ? sku : 'Out of Stock';
    }
</script>

@endsection
