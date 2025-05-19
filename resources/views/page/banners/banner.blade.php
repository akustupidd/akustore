@extends('layout.app')
@section('title') {{'Banners'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Banner Table</h5>
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
                    <form action="{{ route('banner') }}" method="GET" class="d-flex align-items-center justify-content-end" id="search">
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
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($banners->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No results found for "{{ $search_value }}"</td>
                        </tr>
                    @else
                        @foreach($banners as $key => $banner)
                        <tr>
                            <td>{{ $banners->perPage() * ($banners->currentPage() - 1) + $key + 1 }}</td>
                            <td>
                                <img src="{{ asset('uploads/banners/' . $banner->image) }}" alt="banner" style="width: 30px; height: auto;">
                            </td>
                            <td>{{ $banner->title }}</td>
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
                                            data-id="{{ $banner->id }}"
                                            data-title="{{ $banner->title }}"
                                            data-image="{{ $banner->image }}">
                                            <i class="bx bx-edit-alt me-2"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="{{ route('deltbanner', ['id' => $banner->id]) }}" onclick="return confirmation(event)">
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
                        <a class="page-link" href="{{ $banners->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $banners->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $banners->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($banners->getUrlRange(1, $banners->lastPage()) as $page => $url)
                        <li class="page-item {{ $banners->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $banners->currentPage() == $banners->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $banners->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $banners->url($banners->lastPage()) }}" aria-label="Last">
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
                <h5 class="modal-title" id="modalTitle">Add New Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="titleBackdrop" class="form-label">Banner Title</label>
                    <input type="text" id="titleBackdrop" name="title" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="subTitleBackdrop" class="form-label">Sub Title</label>
                    <input type="text" id="subTitleBackdrop" name="sub_title" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="imageBackdrop" class="form-label">Banner Image</label>
                    <input type="file" id="imageBackdrop" name="image" class="form-control" accept="image/*">
                </div>
                <div class="mb-3 text-center">
                    <label for="previewImage" class="form-label d-block">Preview</label>
                    {{-- <img id="previewImage" src="" alt="Image Preview" class="img-thumbnail" style="max-height: 150px;"> --}}
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
    // Handle Add New Button
    document.querySelector('.btn-add-new').addEventListener('click', () => {
        document.getElementById('modalTitle').textContent = 'Add New Banner';
        document.getElementById('titleBackdrop').value = '';
        document.getElementById('subTitleBackdrop').value = '';
        document.getElementById('imageBackdrop').value = '';
        document.getElementById('previewImage').src = '';
        document.querySelector('form.modal-content').setAttribute('action', '{{ route('insertbanner') }}');
        document.getElementById('modalMethod').value = 'POST';
    });

    // Handle Edit Button
    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const title = this.dataset.title;
            const subTitle = this.dataset.sub_title;
            const image = this.dataset.image;

            document.getElementById('modalTitle').textContent = 'Edit Banner';
            document.getElementById('titleBackdrop').value = title;
            document.getElementById('subTitleBackdrop').value = subTitle;
            document.getElementById('previewImage').src = `/uploads/banners/${image}`;
            document.querySelector('form.modal-content').setAttribute('action', `{{ route('updatebanner', ':id') }}`.replace(':id', id));
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
