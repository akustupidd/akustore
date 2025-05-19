@extends('layout.app')
@section('title') {{'User'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">User Table</h5>
            <a type="button" class="btn btn-success btn-add-new" href="{{ route('insert-user') }}">
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
                    <form action="{{ route('user') }}" method="GET" id="search" class="d-flex align-items-center justify-content-end">
                        @csrf
                        <input type="search" name="searchValue" class="form-control form-control-sm me-2" placeholder="Search..." value="{{ request('searchValue') }}" onchange="document.getElementById('search').submit();" style="max-width: 300px;" />
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
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $users->perPage() * ($users->currentPage() - 1) + $key + 1 }}</td>
                            <td>
                                @php
                                    $defaultImage = asset('assets/img/avatars/' . ($user->gender === 'female' ? 'female.jpg' : ($user->gender === 'male' ? 'male.jpg' : 'other.jpg')));
                                    $imagePath = $user->image ? asset('uploads/users/' . $user->image) : $defaultImage;
                                @endphp
                                <img src="{{ $imagePath }}"
                                     alt="User Image"
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal"
                                     data-user-id="{{ $user->id }}"
                                     data-img-src="{{ $imagePath }}"
                                     data-name="{{ $user->name }}"
                                     data-created="{{ \Carbon\Carbon::parse($user->created_at)->diffForHumans() }}">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role_name }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('update-user', $user->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('delete-user', $user->id) }}" onclick="return confirmation(event)"><i class="bx bx-trash me-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">No users found</td></tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $users->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $users->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $users->currentPage() == $users->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $users->url($users->lastPage()) }}" aria-label="Last">
                            <i class="tf-icon bx bx-chevrons-right bx-sm"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!--/ Pagination -->
        </div>
    </div>
</div>

<!-- Modal Template -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel" style="text-align: center; width: 100%"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="User Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalLabel = document.getElementById('imageModalLabel');

        imageModal.addEventListener('show.bs.modal', function (event) {
            const triggerElement = event.relatedTarget;
            const userName = triggerElement.getAttribute('data-name');
            const userCreated = triggerElement.getAttribute('data-created');
            const imgSrc = triggerElement.getAttribute('data-img-src');

            modalLabel.innerHTML = `${userName} | Created: ${userCreated}`;
            modalImage.src = imgSrc;
        });
    });
</script>

@endsection
