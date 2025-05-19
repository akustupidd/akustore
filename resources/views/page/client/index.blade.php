@extends('layout.app')
@section('title') {{ 'Customers' }} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Customer Table</h5>
            <a type="button" class="btn btn-success btn-add-new" href="{{ route('client.insert') }}">
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
                    <form action="{{ route('client') }}" method="GET" id="search" class="d-flex align-items-center justify-content-end">
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
                        <th>Email</th>
                        <th>Is Active</th>
                        <th>IP</th>
                        <th>Last Active</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Date of Birth</th>
                        <th>Last Location</th>
                        <th>Last Device</th>
                        <th>Last Browser</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $key => $customer)
                        <tr>
                            <td>{{ $customers->perPage() * ($customers->currentPage() - 1) + $key + 1 }}</td>
                            <td>
                                @php
                                    $defaultImage = asset('assets/img/avatars/' . ($customer->gender === 'female' ? 'female.jpg' : ($customer->gender === 'male' ? 'male.jpg' : 'other.jpg')));
                                    $imagePath = $customer->image ? asset('uploads/users/' . $customer->image) : $defaultImage;
                                @endphp
                                <img src="{{ $imagePath }}"
                                     alt="Customer Image"
                                     style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;"
                                     data-bs-toggle="modal"
                                     data-bs-target="#imageModal"
                                     data-customer-id="{{ $customer->id }}"
                                     data-img-src="{{ $imagePath }}"
                                     data-name="{{ $customer->name }}"
                                     data-dob="{{ \Carbon\Carbon::parse($customer->dob)->age }} years old"
                                     data-gender="{{ ucfirst($customer->gender) }}"
                                     data-created="{{ \Carbon\Carbon::parse($customer->created_at)->diffForHumans() }}">
                            </td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->is_active == 1 ? 'Active' : 'Offline' }}</td>
                            <td>{{ $customer->last_ip }}</td>
                            <td>{{ $customer->last_active }}</td>
                            <td>{{ $customer->phone_number }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>{{ $customer->dob }}</td>
                            <td>{{ $customer->location }}</td>
                            <td>{{ $customer->last_device }}</td>
                            <td>{{ $customer->last_browser }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('client.edit', $customer->id) }}"><i class="bx bx-edit-alt me-2"></i> Edit</a>
                                        <a class="dropdown-item" href="{{ route('client.delete', $customer->id) }}" onclick="return confirmation(event)"><i class="bx bx-trash me-2"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="14" class="text-center">No customers found</td></tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-3">
                <ul class="pagination justify-content-center">
                    <li class="page-item first">
                        <a class="page-link" href="{{ $customers->url(1) }}" aria-label="First">
                            <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item prev {{ $customers->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $customers->previousPageUrl() }}" aria-label="Previous">
                            <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                        </a>
                    </li>
                    @foreach ($customers->getUrlRange(1, $customers->lastPage()) as $page => $url)
                        <li class="page-item {{ $customers->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endforeach
                    <li class="page-item next {{ $customers->currentPage() == $customers->lastPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $customers->nextPageUrl() }}" aria-label="Next">
                            <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                        </a>
                    </li>
                    <li class="page-item last">
                        <a class="page-link" href="{{ $customers->url($customers->lastPage()) }}" aria-label="Last">
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
    document.addEventListener('DOMContentLoaded', function () {
        const imageModal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalLabel = document.getElementById('imageModalLabel');

        imageModal.addEventListener('show.bs.modal', function (event) {
            const triggerElement = event.relatedTarget;
            const customerName = triggerElement.getAttribute('data-name');
            const customerDob = triggerElement.getAttribute('data-dob');
            const customerGender = triggerElement.getAttribute('data-gender');
            const customerCreated = triggerElement.getAttribute('data-created');
            const imgSrc = triggerElement.getAttribute('data-img-src');

            modalLabel.innerHTML = `${customerName} | ${customerDob} | ${customerGender} | ${customerCreated}`;
            modalImage.src = imgSrc;
        });
    });
</script>
<!-- Modal Template -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel" style="text-align: center; width: 100%"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Customer Image" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>


@endsection
