@extends('layout.app')
@section('title') {{ 'Roles' }} @endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">@yield('title') Table</h5>
            <a href="{{ route('insert-role') }}" class="btn btn-success btn-add-new">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <!-- Rows Per Page Selector (optional) -->
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="row_length" name="row_length" class="form-select form-select-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                        </label>
                    </div>
                </div>

            </div>

            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th style="width: 1%">#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @if($roles->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No roles found</td>
                        </tr>
                    @else
                        @foreach($roles as $key => $item)
                        <tr>
                            <td>{{ $roles->perPage() * ($roles->currentPage() - 1) + $key + 1 }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update-role', $item->id) }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete-role', $item->id) }}" onclick="return confirmation(event)">
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
                    <li class="page-item first {{ $roles->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $roles->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $roles->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $roles->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>

                    @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                        <li class="page-item {{ $roles->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach

                    <li class="page-item next {{ $roles->currentPage() == $roles->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $roles->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last {{ $roles->currentPage() == $roles->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $roles->url($roles->lastPage()) }}" aria-label="Last">
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
