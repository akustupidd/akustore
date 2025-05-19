@extends('layout.app')
@section('title') {{'Accessaries'}} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="card-header border-0 bg-transparent m-0">Accessaries Table</h5>
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
                    <form action="{{ route('accessaries') }}" method="GET" class="d-flex align-items-center justify-content-end" id="search">
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
                     <th>Name</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                @if($accessaries_type->isEmpty())
                    <tr>
                        <td colspan="3" class="text-center">No results found for "{{ $search_value }}"</td>
                    </tr>
                @else
                    @foreach($accessaries_type as $key => $accessary_type)
                    <tr>
                        <td>{{ $accessaries_type->perPage() * ($accessaries_type->currentPage() - 1) + $key + 1 }}</td>
                        <td>{{ $accessary_type->name }}</td>
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
                                        data-id="{{ $accessary_type->id }}"
                                        data-name="{{ $accessary_type->name }}">
                                        <i class="bx bx-edit-alt me-2"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="{{ route('delete-accessaries', $accessary_type->id) }}" onclick="return confirmation(event)">
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
                       <a class="page-link" href="{{ $accessaries_type->url(1) }}" aria-label="First">
                           <i class="tf-icon bx bx-chevrons-left bx-sm"></i>
                       </a>
                   </li>
                   <li class="page-item prev {{ $accessaries_type->onFirstPage() ? 'disabled' : '' }}">
                       <a class="page-link" href="{{ $accessaries_type->previousPageUrl() }}" aria-label="Previous">
                           <i class="tf-icon bx bx-chevron-left bx-sm"></i>
                       </a>
                   </li>
                   @foreach ($accessaries_type->getUrlRange(1, $accessaries_type->lastPage()) as $page => $url)
                   <li class="page-item {{ $accessaries_type->currentPage() == $page ? 'active' : '' }}">
                       <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                   </li>
                   @endforeach
                   <li class="page-item next {{ $accessaries_type->currentPage() == $accessaries_type->lastPage() ? 'disabled' : '' }}">
                       <a class="page-link" href="{{ $accessaries_type->nextPageUrl() }}" aria-label="Next">
                           <i class="tf-icon bx bx-chevron-right bx-sm"></i>
                       </a>
                   </li>
                   <li class="page-item last">
                       <a class="page-link" href="{{ $accessaries_type->url($accessaries_type->lastPage()) }}" aria-label="Last">
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
        <form class="modal-content" method="POST" action="">
            @csrf
            <input type="hidden" name="_method" id="modalMethod" value="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Add New Accessary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="nameBackdrop" class="form-label">Accessary Name</label>
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
    document.querySelectorAll('.btn-add-new').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalTitle').textContent = 'Add New Accessary';
            document.getElementById('nameBackdrop').value = '';
            document.querySelector('form.modal-content').setAttribute('action', '{{ route('insert-data-accessaries') }}');
            document.getElementById('modalMethod').value = 'POST';
        });
    });

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            document.getElementById('modalTitle').textContent = 'Edit Accessary';
            document.getElementById('nameBackdrop').value = name;
            document.querySelector('form.modal-content').setAttribute('action', `{{ route('update-data-accessaries', ':id') }}`.replace(':id', id));
            document.getElementById('modalMethod').value = 'PUT';
        });
    });
</script>
@endsection
