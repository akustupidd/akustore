@extends('layout.web-app.app')
@section('title') {{'Favorite'}} @endsection
@section('content-web')
<div class="container py-3">
    <div class="row mt-5 mb-5">
        @include('comons.menu-side-seeting')
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center pb-4 pb-lg-3 mb-lg-3">
                <h3 class="m-0 p-0" style="font-size: 25px; color: #144194;">Favorites</h3>
            </div>
            <div class="row border-hover-effect">
                @foreach ($favorites->unique('product_id') as $item)
                <div class="col-lg-4 col-md-4 col-sm-6 col-6" style="padding-top: 15px; padding-bottom: 15px; padding-left: 15px; padding-right: 15px;">
                    <!-- Single Product Start -->
                    <div class="single-ponno-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="{{ route('product-detail', $item->product_id) }}">
                                <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $item->image) }}" alt="{{ $item->name }}">
                            </a>
                            <div class="pro-actions-link">
                                <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="dummy-product-title" data-placement="left">
                                    <i class="icon icon-MusicMixer"></i>
                                </a>
                                <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('dummy-product-title')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                                    <span class="icon icon-Eye"></span>
                                </a>
                            </div>
                          
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4 class="popup_cart_title">
                                    <a href="{{ route('product-detail', $item->product_id) }}">{{ $item->name }}</a>
                                </h4>
                                <p>
                                    <span class="special-price">
                                        <span class="money">${{ number_format($item->price) }}</span>
                                    </span> <br><br>
                                    <!-- Monthly Payment Display -->
                                    <span class="text-primary">
                                        Or ${{ number_format($item->price / 12, 2) }}/mo. for 12 mo.*
                                    </span>
                                </p>
                                
                                <div class="product-rating">
                                    <span class="shopify-product-reviews-badge" data-id="1488429809731"></span>
                                </div>
                            </div>
                        </div>
                        <!-- Product Content End -->
                        <div class="pro-add-cart">
                            <form action="{{ route('remove-from-favorite', $item->id) }}" method="POST" onsubmit="return confirmationform(event)">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn action-btn d-flex justify-content-center align-items-center">
                                    <span class="addto">Remove from Fav.</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- Single Product End -->
                </div>                
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection