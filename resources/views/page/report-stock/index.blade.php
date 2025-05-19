@extends('layout.app')
@section('title') {{ 'Report Stock' }} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">@yield('title') Table</h5>
            <a href="{{ route('insert-stock') }}" class="btn btn-success">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center gap-2">
                            Show
                            <select id="add_row_length" name="add_row_length" aria-controls="add-row" class="form-select form-select-sm">
                                <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('row_length') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-10 d-flex flex-wrap justify-content-end gap-2">
                    <form action="{{ route('report-stock') }}" method="GET" id="filterForm" class="d-flex flex-wrap gap-2">
                        <div class="input-filter d-flex align-items-center gap-2">
                            <label for="start_date" class="form-label m-0">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" class="form-control form-control-sm"
                                value="{{ request('start_date') }}" onchange="document.getElementById('filterForm').submit();">
                        </div>

                        <div class="input-filter d-flex align-items-center gap-2">
                            <label for="end_date" class="form-label m-0">End Date:</label>
                            <input type="date" id="end_date" name="end_date" class="form-control form-control-sm"
                                value="{{ request('end_date') }}" onchange="document.getElementById('filterForm').submit();">
                        </div>

                        <div class="input-filter">
                            <input type="search" name="search" class="form-control form-control-sm"
                                placeholder="Search..." aria-label="Search..." value="{{ request('search') }}"
                                onchange="document.getElementById('filterForm').submit();" />
                        </div>
                    </form>

                    <div class="btn-export">
                        <a href="{{ route('export-stock') }}" class="btn btn-primary btn-sm">
                            <i class="bx bx-export me-1"></i> Export
                        </a>
                    </div>
                </div>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr class="text-nowrap">
                        <th style="width: 1%">#</th>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($report_stocks as $key => $item)
                    <tr>
                        <td>{{ $report_stocks->firstItem() + $key }}</td>
                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ $item->price }}</td>
                        <td>${{ number_format($item->quantity * $item->price, 2) }}</td>
                    </tr>
                    @endforeach

                    <tr class="bg-light fw-bold">
                        <td colspan="3" class="text-center">Sub Total</td>
                        <td>{{ $report_stocks->sum('quantity') }}</td>
                        <td>${{ number_format($report_stocks->sum('price'), 2) }}</td>
                        <td>${{ number_format($report_stocks->sum('price') * $report_stocks->sum('quantity'), 2) }}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item {{ $report_stocks->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $report_stocks->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $report_stocks->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $report_stocks->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>

                    @foreach ($report_stocks->getUrlRange(1, $report_stocks->lastPage()) as $page => $url)
                        <li class="page-item {{ $report_stocks->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item {{ $report_stocks->currentPage() == $report_stocks->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $report_stocks->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item {{ $report_stocks->currentPage() == $report_stocks->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $report_stocks->url($report_stocks->lastPage()) }}" aria-label="Last">
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
