@extends('layout.app')
@section('title') {{'Categories'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Categories Table</h5>
            <button type="button" class="btn btn-success btn-add-new" data-bs-toggle="modal" data-bs-target="#backDropModal">
                <i class="bx bx-plus me-1"></i> Add New
            </button>
        </div>
        <div class="table-responsive text-nowrap">
            <div class="row header-filter-table align-items-center mb-3 px-3">
                <!-- Rows Per Page Selector -->
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

                <!-- Search Bar -->
                <div class="col-sm-12 col-md-10 text-end">
                    <form action="{{ route('category') }}" method="GET" class="d-flex align-items-center justify-content-end" id="search">
                        @csrf
                        <input
                            type="search"
                            name="search"
                            class="form-control form-control-sm me-2"
                            placeholder="Search..."
                            aria-label="Search..."
                            value="{{$search_value}}"
                            style="max-width: 300px;"
                            onchange="document.getElementById('search').submit();"
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
                        <th>Icon</th>
                        <th>Name Categories</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($categories->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No results found for "{{ $search_value }}"</td>
                        </tr>
                    @else
                        @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $categories->perPage() * ($categories->currentPage() - 1) + $key + 1 }}</td>
                            <td>
                                <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="icon" style="width: 30px; height: auto;">
                            </td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <!-- Edit Button -->
                                        <a
                                            class="dropdown-item btn-edit"
                                            href="#"
                                            data-bs-toggle="modal"
                                            data-bs-target="#backDropModal"
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            data-image="{{ $category->image }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete-category', $category->id) }}" onclick="return confirmation(event)">
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
                    <li class="page-item first">
                        <a class="page-link" href="{{ $categories->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                        <li class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $categories->currentPage() == $categories->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $categories->url($categories->lastPage()) }}" aria-label="Last">
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
<!-- Modal -->
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" method="POST" action="" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="modalMethod" value="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nameBackdrop" class="form-label">Category Name</label>
                    <input type="text" id="nameBackdrop" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="imageBackdrop" class="form-label">Category Image</label>
                    <input type="file" id="imageBackdrop" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3 text-center">
                    <label for="previewImage" class="form-label d-block">Preview</label>
                    <img id="previewImage" src="" alt="Image Preview" class="img-thumbnail" style="max-height: 150px;">
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
    // Handle Add New Button
    document.querySelector('.btn-add-new').addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Add New Category';
        document.getElementById('nameBackdrop').value = '';
        document.getElementById('imageBackdrop').value = '';
        document.getElementById('previewImage').src = '';
        document.querySelector('form.modal-content').setAttribute('action', '{{ route('insert.category') }}');
        document.getElementById('modalMethod').value = 'POST';
    });

    // Handle Edit Button
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const image = this.dataset.image;

            document.getElementById('modalTitle').textContent = 'Edit Category';
            document.getElementById('nameBackdrop').value = name;
            document.getElementById('previewImage').src = `/uploads/categories/${image}`;
            document.querySelector('form.modal-content').setAttribute('action', `{{ route('update-data-category', ':id') }}`.replace(':id', id));
            document.getElementById('modalMethod').value = 'PUT';
        });
    });

    // Preview Image on File Selection
    document.getElementById('imageBackdrop').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const previewImage = document.getElementById('previewImage');
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

@endsection
