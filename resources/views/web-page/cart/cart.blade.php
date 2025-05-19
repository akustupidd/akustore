@extends('layout.web-app.app')
@section('title') {{'Cart'}} @endsection
@section('content-web')
<!-- BREADCRUMBS SETCTION START -->
<div class="breadcrumbs-section">
    <div class="breadcrumbs overlay-bg">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="breadcrumbs-inner text-left">
              <nav class="" role="navigation" aria-label="breadcrumbs">
                <ul class="breadcrumb-list">
                  <li>
                    <a href="/" title="Back to the home page">Home</a>
                  </li>
                  <li>
                    <span>Your Shopping Cart</span>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- BREADCRUMBS SETCTION END -->

  <main role="main">
    <div id="shopify-section-template--16424544239814__main" class="shopify-section">
      <!-- Cart Main Area Start -->
      <div class="cart-main-area" id="section-template--16424544239814__main">
        <div class="container">
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <!-- Form Start -->
                <!-- Table Content Start -->
                <div class="table-content cart-table table-responsive mb-45">
                  <table>
                    <thead>
                      <tr>
                        <th class="product-thumbnail">Image</th>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-quantity">Quantity</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php $total = 0 @endphp
                      @if($carts)
                          @foreach($carts as $item)
                              @php
                                  $total += $item->price * $item->quantity; 
                              @endphp
                              <tr>
                                  <td class="product-thumbnail">
                                      <a href="{{ route('product-detail', $item->product_id) }}">
                                          <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{$item->name}}" />
                                      </a>
                                  </td>
                                  <td class="product-name text-left">
                                      <a href="{{ route('product-detail', $item->product_id) }}" class=money>{{$item->name}}</a>
                                      <div class="cart-info">
                                        <span class="justify-content-left text-cart-info {{isset($item->ram) && $item->ram ? 'd-flex' : 'd-none'}}">
                                          <span class="mr-2">Ram</span>
                                          <span>:</span>
                                          <span class="ml-2">{{$item->ram}}</span>
                                        </span>
                                        <span class="justify-content-left text-cart-info {{isset($item->storage) && $item->storage ? 'd-flex' : 'd-none'}}">
                                          <span class="mr-2">Storage</span>
                                          <span>:</span>
                                          <span class="ml-2">{{$item->storage}}</span>
                                        </span>
                                        <span class="justify-content-left text-cart-info {{isset($item->color) && $item->color ? 'd-flex' : 'd-none'}}">
                                          <span class="mr-2">Color</span>
                                          <span>:</span>
                                          <span class="ml-2">{{$item->color}}</span>
                                        </span>
                                      </div>
                                  </td>
                                  <td class="product-price">
                                      <span class="amount">
                                          <span class=money>${{ number_format($item->price, 2) }}</span>
                                      </span>
                                  </td>
                                  <td class="product-quantity product_quantity">
                                    <span class="amount">
                                      <span class=money>{{ $item->quantity }}</span>
                                    </span>
                                  </td>
                                  <td class="product-subtotal">
                                      <span class=money>${{ number_format($item->price * $item->quantity, 2) }}</span>
                                  </td>
                                  <td class="product-remove">
                                    <form action="{{ route('remove-from-cart', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fa fa-times" aria-hidden="true"></i></button>
                                    </form>
                                  </td>
                              </tr>
                          @endforeach
                      @endif
                  </tbody>
                  </table>
                </div>
                <!-- Table Content Start -->
                <div class="row">
                  <!-- Cart Button Start -->
                  <div class="col-md-8 col-sm-12">
                    <div class="buttons-cart">
                      <a href="{{route('product-shop')}}">Continue Shopping</a>
                    </div>
                  </div>
                  <!-- Cart Button Start -->
                  <!-- Cart Totals Start -->
                  <div class="col-md-4 col-sm-12">
                    <div class="cart_totals float-md-right text-md-right">
                      <h2>Cart Totals</h2>
                      <br />
                      <table class="float-md-right">
                        <tbody>
                          <tr class="cart-subtotal">
                            <th>Subtotal</th>
                            <td>
                              <span class="amount">
                                <span class=money>${{number_format($total, 2)}}</span>
                              </span>
                            </td>
                          </tr>
                          <tr class="order-total">
                            <th>Total</th>
                            <td>
                              <strong>
                                <span class="amount">
                                  <span class=money>${{number_format($total, 2)}}</span>
                                </span>
                              </strong>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="wc-proceed-to-checkout">
                        <a href="{{route('checkout')}}" type="submit" class="check_out_btn" name="checkout">Proceed to Checkout</a>
                      </div>
                    </div>
                  </div>
                  <!-- Cart Totals End -->
                </div>
                <!-- Row End -->
                <!-- Form End -->
              </div>
            </div>
          <!-- Row End -->
        </div>
      </div>
      <!-- Cart Main Area End -->
      
      <script>
        $('.product-quantity-2').append(' <span class="dec qtybtn">-</span><span class="inc qtybtn">+</span>');
            $('.qtybtn').on('click', function() {
              var $button = $(this);
              var oldValue = $button.parent().find('input').val();
              if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
              } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                  var newVal = parseFloat(oldValue) - 1;
                } else {
                  newVal = 0;
                }
              }
              $button.parent().find('input').val(newVal);
            });
      </script>
    </div>
</main>
@endsection