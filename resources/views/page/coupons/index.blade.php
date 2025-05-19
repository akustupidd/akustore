@extends('layout.app')
@section('title') {{ 'Coupons' }} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">@yield('title') Table</h5>
            <a href="{{ route('insert-admin-coupon') }}" type="button" class="btn btn-success">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <!-- Rows Per Page Selector -->
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="add_row_length" name="row_length" aria-controls="add-row" class="form-select form-select-sm">
                                <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('row_length') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </label>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th style="width: 1%">#</th>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Value</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($coupons->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No results found for "{{ $search_value }}"</td>
                        </tr>
                    @else
                        @foreach($coupons as $key => $coupon)
                        <tr>
                            <td>{{ $coupons->perPage() * ($coupons->currentPage() - 1) + $key + 1 }}</td>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->title }}</td>
                            <td>${{ $coupon->value }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update-admin-coupon', $coupon->id) }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item text-danger" href="{{ route('delete-admin-coupon', $coupon->id) }}" onclick="return confirmation(event)">
                                            <i class="bx bx-trash me-2"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first {{ $coupons->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $coupons->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $coupons->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $coupons->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($coupons->getUrlRange(1, $coupons->lastPage()) as $page => $url)
                        <li class="page-item {{ $coupons->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $coupons->currentPage() == $coupons->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $coupons->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last {{ $coupons->currentPage() == $coupons->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $coupons->url($coupons->lastPage()) }}" aria-label="Last">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/ Pagination -->
        </div>
    </div>
    <!--/ Responsive Table -->
</div>

@endsection
