@extends('layout.app')
@section('title') {{'Brand'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Brands Table</h5>
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
                    <form action="{{ route('brand') }}" method="GET" class="d-flex align-items-center justify-content-end" id="search">
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
                        <th>Image</th>
                        <th>Name Brand</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($brands->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No results found for "{{ $search_value }}"</td>
                        </tr>
                    @else
                        @foreach($brands as $key => $brand)
                        <tr>
                            <td>{{ $brands->perPage() * ($brands->currentPage() - 1) + $key + 1 }}</td>
                            <td><img src="{{ asset('uploads/brands/' . $brand->image) }}" alt="banner" style="width: 30px;height: auto;"></td>
                            <td>{{ $brand->name }}</td>
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
                                            data-id="{{ $brand->id }}"
                                            data-name="{{ $brand->name }}"
                                            data-image="{{ $brand->image }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('delete-brand', $brand->id) }}" onclick="return confirmation(event)">
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
                    <li class="page-item first {{ $brands->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $brands->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($brands->getUrlRange(1, $brands->lastPage()) as $page => $url)
                        <li class="page-item {{ $brands->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $brands->currentPage() == $brands->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last {{ $brands->currentPage() == $brands->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $brands->url($brands->lastPage()) }}" aria-label="Last">
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
                <h5 class="modal-title" id="modalTitle">Add New Brand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nameBackdrop" class="form-label">Brand Name</label>
                    <input type="text" id="nameBackdrop" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="imageBackdrop" class="form-label">Brand Image</label>
                    <input type="file" id="imageBackdrop" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3 text-center">
                    <label for="previewImage" class="form-label d-block">Preview</label>
                    <div id="imagePreviewContainer" class="position-relative d-inline-block">
                        <img
                            id="previewImage"
                            src=""
                            alt="Image Preview"
                            class="img-thumbnail shadow-sm"
                            style="max-height: 150px; max-width: 100%; object-fit: cover;"
                        >
                        <div
                            id="placeholderText"
                            class="position-absolute top-50 start-50 translate-middle text-muted"
                            style="font-size: 14px; display: none;"
                        >
                            No image selected
                        </div>
                    </div>
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
    document.getElementById('imageBackdrop').addEventListener('change', function (event) {
    const file = event.target.files[0];
    const previewImage = document.getElementById('previewImage');
    const placeholderText = document.getElementById('placeholderText');

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result; // Set the new image preview
            previewImage.style.display = 'block'; // Ensure the image is visible
            placeholderText.style.display = 'none'; // Hide the placeholder
        };
        reader.readAsDataURL(file);
    } else {
        // Reset to default placeholder if no file is selected
        previewImage.src = '';
        previewImage.style.display = 'none';
        placeholderText.style.display = 'block';
    }
});

// Trigger the modal to reset the preview when adding a new brand
document.querySelectorAll('.btn-add-new').forEach(btn => {
    btn.addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Add New Brand';
        document.getElementById('nameBackdrop').value = '';
        document.getElementById('imageBackdrop').value = '';
        document.getElementById('previewImage').src = '';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('placeholderText').style.display = 'block';
        document.querySelector('form.modal-content').setAttribute('action', '{{ route('insert-data-brand') }}');
        document.getElementById('modalMethod').value = 'POST';
    });
});

// Trigger the modal to set existing data for editing
document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const image = this.dataset.image;
        document.getElementById('modalTitle').textContent = 'Edit Brand';
        document.getElementById('nameBackdrop').value = name;
        document.getElementById('previewImage').src = `/uploads/brands/${image}`; // Show the current image
        document.getElementById('previewImage').style.display = 'block';
        document.getElementById('placeholderText').style.display = 'none';
        document.querySelector('form.modal-content').setAttribute('action', `{{ route('edit-data-brand', ':id') }}`.replace(':id', id));
        document.getElementById('modalMethod').value = 'PUT';
    });
});

</script>


@endsection
