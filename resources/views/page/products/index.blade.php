@extends('layout.app')
@section('title') {{'Product'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Product Table</h5>
            <a type="button" class="btn btn-success btn-add-new" href="{{ route('insert.product') }}">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="add_row_length" name="add_row_length" class="form-select form-select-sm">
                                @foreach([10, 25, 50, 100] as $length)
                                    <option value="{{ $length }}" {{ request('row_length') == $length ? 'selected' : '' }}>{{ $length }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-10 text-end">
                    <form action="{{ route('product') }}" method="GET" id="search" class="d-flex align-items-center justify-content-end">
                        @csrf
                        <input type="search" name="search" class="form-control form-control-sm me-2" placeholder="Search..." value="{{ request('search') }}" onchange="document.getElementById('search').submit();" style="max-width: 300px;" />
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bx bx-search"></i>
                        </button>
                    </form>
                </div>
            </div>

            <table class="table table-hover table-striped align-middle text-center">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Type</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Product Type</th>
                        <th>Accessories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key => $product)
                        <tr>
                            <td>{{ $products->perPage() * ($products->currentPage() - 1) + $key + 1 }}</td>
                            <td><img src="{{ asset('uploads/products/' . $product->image) }}" alt="banner" style="width: 30px;height: auto;"></td>
                            <td>{{ $product->name }}</td>
                            <td>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</td>
                            <td>{{ $product->stock ? $product->stock->quantity : 'N/A' }}</td>
                            <td><span class="status-color-type">{{ $product->type }}</span></td>
                            <td>{{ $product->category_name }}</td>
                            <td>{{ $product->brand_name }}</td>
                            <td>{{ $product->products_type_name }}</td>
                            <td>{{ $product->accessary_name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update.product', $product->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('delete-product', $product->id) }}" onclick="return confirmation(event)"><i class="bx bx-trash me-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="11" class="text-center">No products found</td></tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $products->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $products->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        <li class="page-item {{ $products->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $products->url($products->lastPage()) }}" aria-label="Last">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/ Pagination -->
        </div>
    </div>
</div>

@endsection
