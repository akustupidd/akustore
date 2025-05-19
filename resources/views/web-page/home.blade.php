@extends('layout.web-app.app')
@section('title') {{'Home'}} @endsection
@section('content-web')
<main role="main">
  <div id="shopify-section-template--15048369078470__main" class="shopify-section">
    <!-- Slider Area Start -->
    <div class="slider-area" id="section-template--15048369078470__main">
      <!-- Slider Area Start Here -->
      <div class="slider-activation owl-carousel">
        <!-- Start Single Slide --> 
        @foreach($slide_banners as $slide_banner) 
        <div id="block-f68ffe7c-7255-4ef8-8bfb-4a232495a3e0" class="slide align-center-left fullscreen animation-style-01  bg-image-1 " style="background-image:url(assets-web/images/s1.jpg)">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-5 col-md-5">
                <div class="sldier-right-img">
                  <img src="{{ asset('uploads/banners/' . $slide_banner->image) }}" alt="{{ $slide_banner->title }}">
                </div>
              </div>
              <div class="col-lg-7 col-md-7">
                <div class="slider-content content-2 text-left">
                  <h1>{{$slide_banner->title}}</h1>
                  <p>{{$slide_banner->sub_title}}</p>
                  <div class="slide-btn small-btn">
                    <a href="{{route('product-shop')}}">Shop Now</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> @endforeach
        <!-- End Single Slide -->
      </div>
      <!-- Slider Area End Here -->
    </div>
    <!-- Slider Area End -->
    <script>
     /*----------------------------
    6. Slider Activation
    -----------------------------*/
    $("#section-template--15048369078470__main .slider-activation").owlCarousel({
        loop: true,
        margin: 0,
        nav: true,
        autoplay: true,
        animateOut: 'fadeOut',
        animateIn: 'fadeIn',
        items: 1,
        autoplayTimeout: 4000,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        dots: true,
        autoHeight: true,
        lazyLoad: true,
    });
    </script>
  </div>
  <!-- popular_brand -->
  <div class="brand bg-white pt-3">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 mb-3">
        <div class="home-title mb-0 mr-2 mb-xl-4">
            POPULAR BRANDS
        </div>
        <div class="row row-cols-4 row-cols-lg-10 no-gutters">
          @foreach ($brands as $brand )
            <div class="col rounded-lg border-0 overflow-hidden p-0 m-1">
              <a href="{{route('product-shop', 'brand_name='.$brand->name)}}" class="d-block">
                <img src="{{asset('uploads/brands/'. $brand->image)}}" class="rounded d-block img-fluid" alt="{{$brand->name}}">
              </a>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <div id="shopify-section-template--15048369078470__1631534148e9e9cfce" class="shopify-section">
    <!-- Hot Deal Area Start Here -->
    <div class="hot-deal" id="section-template--15048369078470__1631534148e9e9cfce">
      <div class="container">
        <div class="row align-items-center flex-row-reverse">
          <div class="col-xl-3 col-md-12 ">
            <!-- Single Product Start -->
            <div class="hot-deal deal-active owl-carousel">
              <!-- Single Product Start -->
              @foreach($products as $product)
                @if($product->product_type === 3)
                  <div class="single-ponno-product 13333050097731">
                    
                    <!-- Product Image Start -->
                    <div class="pro-img">
                      <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                        <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                        <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                      </a>
                      <div class="pro-actions-link">
                        <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="" data-original-title="Compare" data-placement="left" title="Compare View">
                          <i class="icon icon-MusicMixer"></i>
                        </a>
                        <a href="#" class="action-btn quick-view" data-toggle="modal" data-target="#productModal" data-id="{{$product->id}}" title="Quick View">
                          <span class="icon icon-Eye"></span>
                        </a>
                      </div>
                      
                      <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new" href="{{ route('favorite-add', $product->id) }}" button-wishlist data-product-handle="" title="Wishlist">
                        <i class="ti-heart"></i>
                        <i class="ti-settings fa-spin"></i>
                        <i class="fa fa-heart"></i>
                      </a>
                      @if ($product->type == 'new product')
                        <div class="new-arrival">
                          <img src="/assets-web/images/icons/New.png" alt="new-arrival">
                        </div>
                      @endif
                    </div>
                    <!-- Product Image End -->
                    <!-- Product Content Start -->
                    <div class="pro-content">
                      <div class="pro-info">
                        <h4 class="popup_cart_title">
                          <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                        </h4>
                        <p>
                          <span class="special-price">
                            <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                          </span>
                        </p>
                      </div>
                    </div>
                    <!-- Product Content End -->
                    <!-- Add to cart start -->
                    <div class="pro-add-cart">
                      <a href="{{ route('cart.add', $product->id)  }}" class="action-btn">
                        <span class="addto">Add To Cart</span>
                      </a>
                      
                    </div>
                    <!-- Add to cart end -->
                  </div>
                @endif
              @endforeach
              <!-- Single Product End -->
            </div>
            <!-- Single Product End -->
          </div>
          <div class="col-xl-9 col-md-12 ">
            <div class="single-hot-deal">
              <div class="row align-items-center">
                <div class="col-lg-7 col-md-8">
                  <div class="deal-content text-left">
                    <div class="deal-text ">
                      <h6>Hot Deal</h6>
                      <h2>{{$features_top->title}}</h2>
                      <p>{{$features_top->sub_title}}</p>
                    </div>
                    <div class="countdown text-center d-none" data-countdown="2025/07/1"></div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-4 mt-sm-40">
                  <div class="deal-img">
                    <img src="{{ asset('uploads/features/' . $features_top->image) }}" alt="{{$features_top->name}}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hot Deal Area End Here -->
    <script>
    /*----------------------------------------
    12. Deal Product Activation
    ----------------------------------------*/
      $('#section-template--15048369078470__1631534148e9e9cfce .deal-active').owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        smartSpeed: 500,
        autoplayTimeout: 5000,
        autoplay: true,
        margin: 30,
        responsive: {
          0: {
            items: 1
          },
          480: {
            items: 2
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: 1
          }
        }
      })
    </script>
  </div>
  <div id="shopify-section-template--15048369078470__163153428287f898ba" class="shopify-section">
    <!-- Featured Product Start Here -->
    <div class="featured-pro" id="section-template--15048369078470__163153428287f898ba">
      <div class="container">
        <div class="main-product-tab-area">
          <!-- Nav tabs -->
          <ul class="nav tabs-area pro-tabs-area" role="tablist">
            <li class="nav-item">
              <a class="active" data-toggle="tab" href="#feature-new-products">New Product</a>
            </li>
            <li class="nav-item">
              <a class="" data-toggle="tab" href="#feature">Featured</a>
            </li>
            <li class="nav-item">
              <a class="" data-toggle="tab" href="#feature-best-deal">Best deal</a>
            </li>
          </ul>
          <!-- Tab Contetn Start -->
          <div class="tab-content">
            <div id="feature-new-products" class="tab-pane fade active show">
              <!-- Best Deal Product Activation Start Here -->
              <div class="feature-pro-active owl-carousel">
                <!-- Single Product Start -->
                @foreach($products as $product)
                  @if($product->type === 'new product')
                    <div class="single-ponno-product">
                      <!-- Product Image Start -->
                      <div class="pro-img">
                        <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                          <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                          <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                        </a>
                        <div class="pro-actions-link">
                          <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="dummy-product-title" data-original-title="Compare" data-placement="left" title="Compare View">
                            <i class="icon icon-MusicMixer"></i>
                          </a>
                          <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('dummy-product-title')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                            <span class="icon icon-Eye"></span>
                          </a>
                        </div>
                        <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new"  href="{{ route('favorite-add', $product->id)  }}" button-wishlist data-product-handle="dummy-product-title" title="Wishlist">
                          <i class="ti-heart"></i>
                          <i class="ti-settings fa-spin"></i>
                          <i class="fa fa-heart"></i>
                        </a>
                        <div class="new-arrival">
                          <img src="/assets-web/images/icons/New.png" alt="new-arrival">
                        </div>
                      </div>
                      <!-- Product Image End -->
                      <!-- Product Content Start -->
                      <div class="pro-content">
                        <div class="pro-info">
                          <h4 class="popup_cart_title">
                            <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                          </h4>
                          <p>
                            <span class="special-price">
                              <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                            </span>
                            @if($product->discount_price)
                              <span class="special-price-old">
                                <span class=money>${{$product->discount_price}}</span>
                              </span>
                            @endif
                          </p>
                        </div>
                        <div class="pro-add-cart">
                          <a href="{{ route('cart.add', $product->id)  }}" class="action-btn">
                            <span class="addto">Add To Cart</span>
                          </a>
                        </div>
                      </div>
                      <!-- Product Content End -->
                    </div>
                  @endif
                @endforeach
                <!-- Single Product End -->
              </div>
              <!-- Tab Content End -->
            </div>
            <div id="feature" class="tab-pane fade ">
              <!-- Best Deal Product Activation Start Here -->
              <div class="feature-pro-active owl-carousel">
                <!-- Single Product Start -->
                @foreach($products as $product)
                  @if($product->type === 'feature')
                    <div class="single-ponno-product 13333050097731">
                      <!-- Product Image Start -->
                      <div class="pro-img">
                        <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                          <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                          <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                        </a>
                        <div class="pro-actions-link">
                          <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="" data-original-title="Compare" data-placement="left" title="Compare View">
                            <i class="icon icon-MusicMixer"></i>
                          </a>
                          <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                            <span class="icon icon-Eye"></span>
                          </a>
                        </div>
                        <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new" href="{{ route('favorite-add', $product->id)}}" button-wishlist data-product-handle="" title="Wishlist">
                          <i class="ti-heart"></i>
                          <i class="ti-settings fa-spin"></i>
                          <i class="fa fa-heart"></i>
                        </a>
                      </div>
                      <!-- Product Image End -->
                      <!-- Product Content Start -->
                      <div class="pro-content">
                        <div class="pro-info">
                          <h4 class="popup_cart_title">
                            <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                          </h4>
                          <p>
                            <span class="special-price">
                              <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                            </span>
                          </p>
                        </div>
                        <div class="pro-add-cart">
                          <a href="{{ route('cart.add', $product->id)  }}" class="action-btn">
                            <span class="addto">Add To Cart</span>
                          </a>
                        </div>
                      </div>
                      <!-- Product Content End -->
                    </div>
                  @endif
                @endforeach
                <!-- Single Product End -->
               
              </div>
              <!-- Tab Content End -->
            </div>
            <div id="feature-best-deal" class="tab-pane fade ">
              <!-- Best Deal Product Activation Start Here -->
              <div class="feature-pro-active owl-carousel">
                <!-- Single Product Start -->
                @foreach($products as $product)
                  @if($product->type === 'best deal')
                    <div class="single-ponno-product 13333050097731">
                      <!-- Product Image Start -->
                      <div class="pro-img">
                        <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                          <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                          <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                        </a>
                        <div class="pro-actions-link">
                          <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="" data-original-title="Compare" data-placement="left" title="Compare View">
                            <i class="icon icon-MusicMixer"></i>
                          </a>
                          <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                            <span class="icon icon-Eye"></span>
                          </a>
                        </div>
                        <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new" href="{{ route('favorite-add', $product->id)}}" button-wishlist data-product-handle="" title="Wishlist">
                          <i class="ti-heart"></i>
                          <i class="ti-settings fa-spin"></i>
                          <i class="fa fa-heart"></i>
                        </a>
                      </div>
                      <!-- Product Image End -->
                      <!-- Product Content Start -->
                      <div class="pro-content">
                        <div class="pro-info">
                          <h4 class="popup_cart_title">
                            <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                          </h4>
                          <p>
                            <span class="special-price">
                              <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                            </span>
                          </p>
                        </div>
                        <div class="pro-add-cart">
                          <a href="{{ route('cart.add', $product->id)  }}" class="action-btn" >
                            <span class="addto">Add To Cart</span>
                          </a>
                        </div>
                      </div>
                      <!-- Product Content End -->
                    </div>
                  @endif
                @endforeach
                <!-- Single Product End -->
              </div>
              <!-- Tab Content End -->
            </div>
          </div>
          <!-- main-product-tab-area-->
        </div>
      </div>
    </div>
    <!-- Featured Product End Here -->
    <script>
      /*----------------------------------------
    10. Featured Product Activation
    ----------------------------------------*/
      $('#section-template--15048369078470__163153428287f898ba .feature-pro-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 30,
        autoplay: false,
        responsive: {
          0: {
            items: 1,
            autoplay: true,
            smartSpeed: 500
          },
          480: {
            items: 2
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: 4
          }
        }
      })
      
    </script>
  </div>
  <div id="shopify-section-template--15048369078470__1631534362f427a64e" class="shopify-section">
    <!-- Dual Banner Start Here -->
    <div class="dual-banner" id="section-template--15048369078470__1631534362f427a64e">
      <div class="container">
        <div class="row">
          @foreach($features_center as $feature_center)
            <div class="col-lg-6 col-12 ">
              <!-- Single Bannner Start Here -->
              <div class="single-banner zoom">
                <a href="/collections/all">
                  <img src="{{ asset('uploads/features/' . $feature_center->image) }}" alt="">
                </a>
              </div>
              <!-- Single Bannner End Here -->
            </div>
          @endforeach
        </div>
      </div>
    </div>
    <!-- Dual Banner End Here -->
  </div>
  <div id="shopify-section-template--15048369078470__1631534411b078bdde" class="shopify-section">
    <!-- Laptop & Computer Products Start Here -->
    <div class="lapto-computers" id="section-template--15048369078470__1631534411b078bdde">
      <div class="container">
        <div class="electronics-list-area d-flex flex-wrap align-items-center justify-content-between mb-10">
          <h5 class="home-title mb-0 mr-2">MOBILE PHONE</h5>
          <div class="e-tabs-list">
            <!-- Nav tabs -->
            <ul class="nav tabs-area categorie-tabs-area" role="tablist">
              <li class="nav-item">
                <a class="active" data-toggle="tab" href="#section-feature">Featured</a>
              </li>
              <li class="nav-item">
                <a class="" data-toggle="tab" href="#section-new-product">New Product</a>
              </li>
              <li class="nav-item">
                <a class="" data-toggle="tab" href="#section-best-deal">Best deal</a>
              </li>
            </ul>
            <!-- Tab Contetn Start -->
          </div>
        </div>
        <!-- Categorie Tab Contetn Start Here -->
        <div class="tab-content pro-style-changer">
          <!-- Computer Product Start Here -->
          <div id="section-feature" class="tab-pane fade active show">
            <div class="row">
              @foreach($products as $product)
                @if ($product->product_type == '1')
                  @if($product->type === 'feature')
                    <div class="col-lg-4 col-md-6">
                      <!-- Single Product Start -->
                      <div class="single-ponno-product  13333050097731">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                          <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                            <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}"></a>
                          </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                          <div class="pro-info">
                            <h4 class="popup_cart_title">
                              <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                            </h4>
                            <p>
                              <span class="special-price">
                                <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                              </span>
                            </p>
                          </div>
                        </div>
                        <!-- Product Content End -->
                      </div>
                      <!-- Single Product End -->
                    </div>
                  @endif
                @endif
              @endforeach
            </div>
          </div>
          <!-- Computer Product End Here -->
          <!-- Computer Product Start Here -->
          <div id="section-new-product" class="tab-pane fade ">
            <div class="row">
              @foreach($products as $product)
                @if ($product->product_type == '1')
                  @if($product->type === 'new product')
                    <div class="col-lg-4 col-md-6">
                      <!-- Single Product Start -->
                      <div class="single-ponno-product ">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                          <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                            <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                          </a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                          <div class="pro-info">
                            <h4 class="popup_cart_title">
                              <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                            </h4>
                            <p>
                              <span class="special-price">
                                <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                              </span>
                              @if($product->discount_price)
                                <span class="special-price-old">
                                  <span class=money>${{$product->discount_price}}</span>
                                </span>
                              @endif
                            </p>
                          </div>
                        </div>
                        <!-- Product Content End -->
                      </div>
                      <!-- Single Product End -->
                    </div>
                  @endif
                @endif
              @endforeach
            </div>
          </div>
          <!-- Computer Product End Here -->
          <!-- Computer Product Start Here -->
          <div id="section-best-deal" class="tab-pane fade ">
            <div class="row">
            @foreach($products as $product)
              @if ($product->product_type == '1')
                @if($product->type === 'best deal')
                  <div class="col-lg-4 col-md-6">
                    <!-- Single Product Start -->
                    <div class="single-ponno-product ">
                      <!-- Product Image Start -->
                      <div class="pro-img">
                        <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                          <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                        </a>
                      </div>
                      <!-- Product Image End -->
                      <!-- Product Content Start -->
                      <div class="pro-content">
                        <div class="pro-info">
                          <h4 class="popup_cart_title">
                            <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                          </h4>
                          <p>
                            <span class="special-price">
                              <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                            </span>
                            @if($product->discount_price)
                              <span class="special-price-old">
                                <span class=money>${{$product->discount_price}}</span>
                              </span>
                            @endif
                          </p>
                        </div>
                      </div>
                      <!-- Product Content End -->
                    </div>
                    <!-- Single Product End -->
                  </div>
                @endif
              @endif
              @endforeach
            </div>
          </div>
          <!-- Computer Product End Here -->
        </div>
          <!-- Categorie Tab Contetn End Here -->
      </div>
    </div>
    <!-- Laptop & Computer Products End Here -->
  </div>

  <div id="popular_category" class="pb-4">
    <section class="bg-secondary pt-3 pb-4 pb-xl-5 pt-xl-5 categories">
      <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 pb-4">
          <h2 class="home-title mb-0 mr-2 mb-xl-4">POPULAR CATEGORIES</h2>
        </div>
        <div class="brand-caregory-active owl-carousel pb-4">
          @foreach ($categories as $category)
            <div class="card">
              <div class="card-body px-2">
                <div class="d-flex align-items-center">
                  <div>
                    <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="{{$category->name}}" width="25">
                  </div>
                  <div class="info">
                    <h6 class="widget-product-title">
                      <a href="{{route('product-shop', 'category_name[]='.$category->name)}}">{{$category->name}}</a>
                    </h6>
                    <small>
                      <a class="text-muted font-size-xs" href="{{route('product-shop', 'category_name[]='.$category->name)}}"> 
                        view more 
                        <i class="bx bx-chevrons-right font-size-xs"></i>
                      </a>
                    </small>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>
    <script>
      /*----------------------------------------
      10. Slide Only popular category Activation
      ----------------------------------------*/
      $('#popular_category .brand-caregory-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 30,
        autoplay: false,
        responsive: {
          0: {
            items: 1,
            autoplay: true,
            smartSpeed: 500
          },
          480: {
            items: 2
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: 5
          }
        }
      })
    </script>
  </div>
  
  <div id="shopify-section-template--15048369078470__163153447223688331" class="shopify-section">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 pb-4">
        <h2 class="home-title mb-0 mr-2">SMART WATCH</h2>
        <div class="">
          <a class="btn btn-link btn-sm" href="{{ route('product-shop', ['product_type_name[]' => 'Smart Watch']) }}">
              View all <i class="bx bx-chevrons-right ml-1 mr-n1"></i>
          </a>
        </div>
      </div>
       <div class="smart-watch-active owl-carousel pb-4">
          <!-- Single Product Start -->
          @foreach($products as $product)
            @if($product->product_type_name == 'Smart Watch')
              <div class="single-ponno-product">
                <!-- Product Image Start -->
                <div class="pro-img">
                  <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                    <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                    <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                  </a>
                  <div class="pro-actions-link">
                    <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="dummy-product-title" data-original-title="Compare" data-placement="left" title="Compare View">
                      <i class="icon icon-MusicMixer"></i>
                    </a>
                    <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('dummy-product-title')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                      <span class="icon icon-Eye"></span>
                    </a>
                  </div>
                  <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new"  href="{{ route('favorite-add', $product->id)  }}" button-wishlist data-product-handle="dummy-product-title" title="Wishlist">
                    <i class="ti-heart"></i>
                    <i class="ti-settings fa-spin"></i>
                    <i class="fa fa-heart"></i>
                  </a>
                  <div class="new-arrival">
                    <img src="/assets-web/images/icons/New.png" alt="new-arrival">
                  </div>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                  <div class="pro-info">
                    <h4 class="popup_cart_title">
                      <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                    </h4>
                    <p>
                      <span class="special-price">
                        <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                      </span>
                      @if($product->discount_price)
                        <span class="special-price-old">
                          <span class=money>${{$product->discount_price}}</span>
                        </span>
                      @endif
                    </p>
                  </div>
                  <div class="pro-add-cart">
                    <a href="{{ route('cart.add', $product->id)  }}" class="action-btn">
                      <span class="addto">Add To Cart</span>
                    </a>
                  </div>
                </div>
                <!-- Product Content End -->
              </div>
            @endif
          @endforeach
          <!-- Single Product End -->
        </div>
    </div>
    <script>
      /*----------------------------------------
    10. Slide Only Smart Watch Activation
    ----------------------------------------*/
      $('#shopify-section-template--15048369078470__163153447223688331 .smart-watch-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 30,
        autoplay: true,
        responsive: {
          0: {
            items: 1,
            autoplay: true,
            smartSpeed: 500
          },
          480: {
            items: 2
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: 4
          }
        }
      })
      
    </script>
  </div>
  <div id="shopify-section-template--15048369078470__163153447223688331" class="shopify-section">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 pb-4">
        <h2 class="home-title mb-0 mr-2">ACCESSARIES</h2>
        <div class="">
          <a class="btn btn-link btn-sm" href="{{ route('product-shop', ['product_type_name[]' => 'Accessories']) }}"> 
            View all <i class="bx bx-chevrons-right ml-1 mr-n1"></i>
          </a>
        </div>
      </div>
       <div class="accessaries-active owl-carousel pb-4">
          <!-- Single Product Start -->
          @foreach($products as $product)
            @if($product->product_type_name == 'Accessories')
              <div class="single-ponno-product">
                <!-- Product Image Start -->
                <div class="pro-img">
                  <a href="{{route('product-detail', ['slug' => $product->slug])}}">
                    <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{$product->name}}">
                    <img class="secondary-img popup_cart_image" src="{{ asset('uploads/products/' . $product->image) }}" alt="">
                  </a>
                  <div class="pro-actions-link">
                    <a href="#" class="compare" data-toggle="tooltip" title="Compare" data-pid="dummy-product-title" data-original-title="Compare" data-placement="left" title="Compare View">
                      <i class="icon icon-MusicMixer"></i>
                    </a>
                    <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('dummy-product-title')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                      <span class="icon icon-Eye"></span>
                    </a>
                  </div>
                  <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new"  href="{{ route('favorite-add', $product->id)  }}" button-wishlist data-product-handle="dummy-product-title" title="Wishlist">
                    <i class="ti-heart"></i>
                    <i class="ti-settings fa-spin"></i>
                    <i class="fa fa-heart"></i>
                  </a>
                  <div class="new-arrival">
                    <img src="/assets-web/images/icons/New.png" alt="new-arrival">
                  </div>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                  <div class="pro-info">
                    <h4 class="popup_cart_title">
                      <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                    </h4>
                    <p>
                      <span class="special-price">
                        <span class=money>${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                      </span>
                      @if($product->discount_price)
                        <span class="special-price-old">
                          <span class=money>${{$product->discount_price}}</span>
                        </span>
                      @endif
                    </p>
                  </div>
                  <div class="pro-add-cart">
                    <a href="{{ route('cart.add', $product->id)  }}" class="action-btn">
                      <span class="addto">Add To Cart</span>
                    </a>
                  </div>
                </div>
                <!-- Product Content End -->
              </div>
            @endif
          @endforeach
          <!-- Single Product End -->
        </div>
    </div>
    <script>
      /*----------------------------------------
    10. Slide Only Smart Watch Activation
    ----------------------------------------*/
      $('#shopify-section-template--15048369078470__163153447223688331 .accessaries-active').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        smartSpeed: 1500,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        margin: 30,
        autoplay: true,
        responsive: {
          0: {
            items: 1,
            autoplay: true,
            smartSpeed: 500
          },
          480: {
            items: 2
          },
          768: {
            items: 2
          },
          992: {
            items: 3
          },
          1200: {
            items: 4
          }
        }
      })
      
    </script>
  </div>
</main>

<!-- Modal -->
{{-- <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Product details will be injected here -->
                <div id="productDetails">
                    <!-- Details will be populated via JavaScript -->
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection