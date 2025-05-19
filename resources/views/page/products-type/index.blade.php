@extends('layout.app')
@section('title') {{'Products Type'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Products Type Table</h5>
            <button type="button" class="btn btn-success btn-add-new" data-bs-toggle="modal" data-bs-target="#backDropModal">
                <i class="bx bx-plus me-1"></i> Add New
            </button>
        </div>

        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <div class="col-sm-12 col-md-2">
                    <div class="dataTables_length">
                        <label class="d-flex align-items-center">
                            <select id="add_row_length" name="add_row_length" aria-controls="add-row" class="form-select form-select-sm">
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
                        <th>#</th>
                        <th>Name Categories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products_type as $key => $product_type)
                    <tr>
                        <td>{{ $products_type->perPage() * ($products_type->currentPage() - 1) + $key + 1 }}</td>
                        <td>{{ $product_type->name }}</td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item btn-edit" href="#" data-bs-toggle="modal" data-bs-target="#backDropModal" data-id="{{ $product_type->id }}" data-name="{{ $product_type->name }}">
                                        <i class="bx bx-edit-alt me-2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('delete-product-type', $product_type->id) }}" onclick="return confirmation(event)">
                                        <i class="bx bx-trash me-2"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             <!-- Pagination -->
             <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $products_type->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $products_type->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products_type->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($products_type->getUrlRange(1, $products_type->lastPage()) as $page => $url)
                        <li class="page-item {{ $products_type->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $products_type->currentPage() == $products_type->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $products_type->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $products_type->url($products_type->lastPage()) }}" aria-label="Last">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/ Pagination -->
        </div>
    </div>
</div>

<!-- Modal for Adding/Editing Product Type -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="" id="modalForm">
            @csrf
            <input type="hidden" name="_method" id="modalMethod" value="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Product Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nameBackdrop" class="form-label">Product Type Name</label>
                    <input type="text" id="nameBackdrop" name="name" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.querySelector('.btn-add-new').addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Add New Product Type';
        document.getElementById('nameBackdrop').value = '';
        document.getElementById('modalForm').setAttribute('action', '{{ route('insert-product-type') }}');
        document.getElementById('modalMethod').value = 'POST';
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('modalTitle').textContent = 'Edit Product Type';
            document.getElementById('nameBackdrop').value = name;
            document.getElementById('modalForm').setAttribute('action', `{{ route('update-product-type', ':id') }}`.replace(':id', id));
            document.getElementById('modalMethod').value = 'PUT';
        });
    });
</script>

@endsection
