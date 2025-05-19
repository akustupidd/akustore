@extends('layout.web-app.app')

@section('title')
    {{ 'My Order' }}
@endsection


@section('content-web')
    <div class="container py-3">
        <div class="row mt-5 mb-5">
            @include('comons.menu-side-seeting')

            <!-- Main Content Area -->
            <div class="col-lg-9"> <!-- Added col-12 for mobile responsiveness -->
                <div class="d-flex justify-content-between align-items-center pb-4 pb-lg-3 mb-lg-3">
                    <h3 class="m-0 p-0" style="font-size: 25px; color: #144194;">@yield('title')</h3>
                </div>

                <!-- Orders Table -->
                <div class="table-responsive font-size-md">
                    <table class="table table-hover mb-0 text-center">
                        <thead class="bg-fill rounded-top">
                            <tr>
                                <th style="min-width: 50px;">#</th>
                                <th style="min-width: 100px;">Order ID</th>
                                <th style="min-width: 100px;">Product ID</th>
                                <th style="min-width: 150px;">Product Name</th>
                                <th style="min-width: 100px;">Quantity</th>
                                <th style="min-width: 100px;">Price</th>
                                <th style="min-width: 150px;">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order_items as $index => $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->product_id }}</td>
                                <td>{{ $item->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->created_at->diffForHumans() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <hr class="pb-4">
            </div>
        </div>
    </div>

@endsection
