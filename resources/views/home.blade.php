@extends('layout.app')
@section('title') {{'Dashboard'}} @endsection
@section('content')

<!-- Content -->
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <div class="col-lg-12 col-md-4 order-1">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon total-sale-color flex-shrink-0">
                  <i class="bx bx-dollar"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('product')}}">View More</a>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-between">
                <div class="content-box">
                  <span class="fw-semibold d-block mb-1"> Total Sale</span>
                  <h3 class="card-title mb-2">${{number_format($total_price, 2, '.', ',')}}</h3>
                </div>
                <div class="total_percent">
                  <small class="text-success fw-semibold">
                    @if (min($total_price / 100, 100) <= 50)
                      <i class="bx bx-down-arrow-alt" style="color: red;"></i> 
                    @else
                      <i class="bx bx-up-arrow-alt"></i> 
                    @endif
                    +{{min($total_price / 100, 100)}}%
                  </small>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon flex-shrink-0">
                  <i class="bx bxs-data"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('product')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Products</span>
              <h3 class="card-title mb-2">{{number_format($qty_products)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon categories-color flex-shrink-0">
                  <i class="bx bx-label"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('category')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Categories</span>
              <h3 class="card-title mb-2">{{count($categories)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon accessaries-color flex-shrink-0">
                  <i class="bx bxs-vial"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('accessaries')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Accessaries</span>
              <h3 class="card-title mb-2">{{count($accessaries)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon brand-color flex-shrink-0">
                  <i class="bx bx-mobile-vibration"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('accessaries')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Brands</span>
              <h3 class="card-title mb-2">{{count($brands)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon blog-color flex-shrink-0">
                  <i class="bx bx-store"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('stock')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Stocks</span>
              <h3 class="card-title mb-2">{{$total_stocks}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon user-color flex-shrink-0">
                <i class="bx bx-group"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('user')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total Client</span>
              <h3 class="card-title mb-2">{{count($customers)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-6 mb-4">
          <div class="card">
            <div class="card-body">
              <div class="card-title d-flex align-items-start justify-content-between">
                <div class="bg-raduis-icon user-color flex-shrink-0">
                  <i class="bx bx-user"></i>
                </div>
                <div class="dropdown">
                  <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                    <a class="dropdown-item" href="{{route('user')}}">View More</a>
                  </div>
                </div>
              </div>
              <span class="fw-semibold d-block mb-1">Total User</span>
              <h3 class="card-title mb-2">{{count($Admin)}}</h3>
              <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80% </small> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- / Content -->

@endsection