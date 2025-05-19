@extends('layout.app')
@section('title') {{ 'Report Stock' }} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="add_row_length" name="add_row_length" class="form-select form-select-sm" onchange="document.getElementById('filterForm').submit();">
                                <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('row_length') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-10 d-flex flex-wrap justify-content-end gap-2">
                    <form action="{{ route('report-sale') }}" method="GET" class="d-flex flex-wrap gap-2" id="filterForm">
                        <div class="d-flex align-items-center">
                            <label for="start_date" class="me-1">Start:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control form-control-sm"
                                value="{{ request('start_date') }}" max="{{ now()->toDateString() }}" onchange="document.getElementById('filterForm').submit();">
                        </div>

                        <div class="d-flex align-items-center">
                            <label for="end_date" class="me-1">End:</label>
                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                class="form-control form-control-sm"
                                value="{{ request('end_date') }}"

                                onchange="document.getElementById('filterForm').submit();">
                        </div>

                        <div class="d-flex align-items-center">
                            <input type="search" name="search" class="form-control form-control-sm" placeholder="Search..."
                                value="{{ request('search') }}" onchange="document.getElementById('filterForm').submit();">
                        </div>
                    </form>

                    <div>
                        <a href="{{ route('export-sale') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-download me-1"></i> Export
                        </a>
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>#</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Ram</th>
                        <th>Storage</th>
                        <th>Color</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_items as $key => $item)
                    <tr>
                        <td>{{ $order_items->perPage() * ($order_items->currentPage() - 1) + $key + 1 }}</td>
                        <td>{{ $item->created_at->timezone('Asia/Phnom_Penh')->format('Y-m-d h:i:s A') }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->ram }}</td>
                        <td>{{ $item->storage }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                        <td>
                            <a href="{{ route('orders.show', $item->order_id) }}" class="btn btn-sm btn-info">
                                View
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="bg-light fw-bold">
                        <td colspan="6" class="text-center">Sub Total</td>
                        <td>{{ $order_items->sum('quantity') }}</td>
                        <td>${{ number_format($order_items->sum('price'), 2) }}</td>
                        <td>${{ number_format($order_items->sum('quantity') * $order_items->avg('price'), 2) }}</td>
                    </tr>

                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first {{ $order_items->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $order_items->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $order_items->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $order_items->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($order_items->getUrlRange(1, $order_items->lastPage()) as $page => $url)
                        <li class="page-item {{ $order_items->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $order_items->currentPage() == $order_items->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $order_items->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last {{ $order_items->currentPage() == $order_items->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $order_items->url($order_items->lastPage()) }}" aria-label="Last">
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
