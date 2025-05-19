@extends('layout.app')
@section('title') {{ 'Order Details' }} @endsection
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="header-table-list d-flex justify-content-between align-items-center mb-3 px-3">
            <h5 class="mt-3">Order Details</h5>
        </div>

        <div class="table-responsive text-nowrap px-3 pb-3">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $order->fname }}</td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $order->lname }}</td>
                    </tr>
                    <tr>
                        <th>Contact</th>
                        <td>{{ $order->contact }}</td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td>{{ $order->country }}</td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $order->address }}</td>
                    </tr>
                    <tr>
                        <th>Apartment</th>
                        <td>{{ $order->apartment }}</td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>{{ $order->city }}</td>
                    </tr>
                    <tr>
                        <th>Postal Code</th>
                        <td>{{ $order->postal_code }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Method</th>
                        <td>{{ $order->shipping }}</td>
                    </tr>
                    <tr>
                        <th>Payment Method</th>
                        <td>{{ $order->payment }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $order->status }}</td>
                    </tr>
                    <tr>
                        <th>Tracking Number</th>
                        <td>{{ $order->tracking_no }}</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>${{ number_format($order->total, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $order->created_at->timezone('Asia/Phnom_Penh')->format('Y-m-d h:i:s A') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ $order->updated_at->timezone('Asia/Phnom_Penh')->format('Y-m-d h:i:s A') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
