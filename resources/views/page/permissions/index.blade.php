@extends('layout.app')
@section('title', 'Permission')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
   <!-- Responsive Table -->
   <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">@yield('title') Table</h5>
            <a href="{{ route('insert-permission') }}" class="btn btn-success btn-add-new">
                <i class="bx bx-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="row_length" name="row_length" aria-controls="permission-table" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('row_length') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="col-sm-12 col-md-10 text-end">
                    <form action="{{ route('permission') }}" method="GET" class="d-flex align-items-center justify-content-end" id="searchForm">
                        <input
                            type="search"
                            name="search"
                            class="form-control form-control-sm me-2"
                            placeholder="Search..."
                            aria-label="Search permissions"
                            value="{{ request('search') }}"
                            style="max-width: 300px;"
                            onchange="document.getElementById('searchForm').submit();"
                        />
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="bx bx-search"></i>
                        </button>
                    </form>
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
                    @if($permissions->isEmpty())
                        <tr>
                            <td colspan="3" class="text-center">No results found for "{{ request('search') }}"</td>
                        </tr>
                    @else
                        @foreach($permissions as $key => $permission)
                        <tr>
                            <td>{{ $permissions->perPage() * ($permissions->currentPage() - 1) + $key + 1 }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update-permission', $permission->id) }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete-permission', $permission->id) }}" onclick="return confirmation(event)">
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
                {{ $permissions->withQueryString()->links() }}
            </nav>
        </div>
    </div>
    <!--/ Responsive Table -->
</div>

@endsection
