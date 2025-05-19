@extends('layout.app')
@section('title') {{'Blog'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Blog Table</h5>
            <a type="button" class="btn btn-success btn-add-new" href="{{ route('insert-blog') }}">
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
                    <form action="{{ route('blog-ad') }}" method="GET" id="search"  class="d-flex align-items-center justify-content-end">
                        @csrf
                        <input type="search" name="search" class="form-control form-control-sm me-2" placeholder="Search..." value="{{ $search_value }}" onchange="document.getElementById('search').submit();" style="max-width: 300px;" />
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
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($blogs as $key => $blog)
                        <tr>
                            <td>{{ $blogs->perPage() * ($blogs->currentPage() - 1) + $key + 1 }}</td>
                            {{-- <td><img src="{{ asset('uploads/blogs/' . $blog->cover_image) }}" alt="banner" style="width: 30px; height: auto;"></td> --}}
                            <td>
                                @if($blog->cover_image) 
                                    {{-- ✅ Display Image if Available --}}
                                    <img src="{{ asset($blog->cover_image) }}" alt="blog image" 
                                         class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                @elseif($blog->video_url)
                                    {{-- ✅ Display Video Only If No Image Exists --}}
                                    <video width="100" height="60" controls>
                                        <source src="{{ asset($blog->video_url) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @else
                                    <span class="text-muted">No Media</span>
                                @endif
                            </td>                                                   
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->category->name ?? 'Uncategorized' }}</td>
                            <td>{{ \Carbon\Carbon::parse($blog->published_at)->format('d M Y') }}</td>
                            <td>
                                <button class="btn btn-sm toggle-status-btn px-3 rounded-pill" 
                                        data-id="{{ $blog->id }}" data-status="{{ $blog->status }}"
                                        style="min-width: 120px;">
                                    @if($blog->status === 'published')
                                        <i class="bx bx-show text-success"></i> <span class="text-success fw-bold">Public</span>
                                    @else
                                        <i class="bx bx-hide text-danger"></i> <span class="text-danger fw-bold">Archived</span>
                                    @endif
                                </button>
                            </td>
                            
                            <td>{{ $blog->admin->name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update-blog', $blog->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('delete-blog', ['id' => $blog->id]) }}" onclick="return confirmation(event)"><i class="bx bx-trash me-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="text-center">No blogs found</td></tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $blogs->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $blogs->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                        <li class="page-item {{ $blogs->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $blogs->currentPage() == $blogs->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $blogs->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $blogs->url($blogs->lastPage()) }}" aria-label="Last">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/ Pagination -->
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".toggle-status-btn").forEach(button => {
            button.addEventListener("click", function () {
                let blogId = this.getAttribute("data-id");
                let currentStatus = this.getAttribute("data-status");

                fetch(`{{ url('/admin/blog/') }}/${blogId}/toggle-status`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === "published") {
                            this.innerHTML = `<i class="bx bx-show text-success"></i> Public`;
                            this.setAttribute("data-status", "published");
                        } else {
                            this.innerHTML = `<i class="bx bx-hide text-danger"></i> Archived`;
                            this.setAttribute("data-status", "archived");
                        }
                    } else {
                        alert("Failed to update blog status.");
                    }
                })
                .catch(error => console.error("Error:", error));
            });
        });
    });
</script>

@endsection
