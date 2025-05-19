{{-- <div class="col-md-12 background-top-header-area">
  <div class="container" style="overflow: hidden;">
    <div class="info-contact float-md-right scrolling-text justify-content-between">
      <p class="text-sm text-gray-700 leading-5"><i class='bx bx-phone'></i>Tel: 086 608 237, 088 722 883 3</p>
      <a href="https://www.facebook.com/profile.php?id=100013282053134" target=
      'blank' class="text-sm text-gray-700 leading-5"><img src="../assets-web/images/fb.svg" alt="logo-fb"></i>Davit Phone Shop</a>
    </div>
  </div>
</div> --}}
<style>

/* Flag style */
.country-flag {
  width: 20px; /* Adjust flag size */
  height: 15px; /* Adjust flag size */
  background-size: cover;
  margin-right: 8px; /* Space between flag and country code */
}

/* Country code text style */
.country-code {
  font-size: 14px;
  font-weight: bold;
  color: #333;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Hover effect for the country code */
.country-code:hover {
  color: #007bff;
}

</style>
<div id="shopify-section-header" class="shopify-section">
  <header class="header-area" id="section-header">
    <div class="header-top">
      <div class="container">
        <div class="row align-items-center text-center text-md-left">
          <!-- Logo Start -->
          <div class="col-md-3 col order-1 order-md-1 mb-sm-30">
            <div class="logo">
              <a href="/" class="theme-logo">
                <img src="{{ asset('../assets-web/images/dark 1.png') }}" alt="Ponno - eCommerce Shopify Theme">              
              </a>
                <span id="countryFlag" class="country-flag"></span>
                <span id="countryCode" class="country-code"></span>
            </div>
          </div>
          <!-- Logo End -->
          <!-- Search Box Start Here -->
          <div class="col-md-6  order-3 order-md-2">
            <div class=" categorie-search-box">
              <form action="/product-shop" method="get" role="search" id="search">
                <input id="search"
                type="search"
                name="search_name"
                value="{{ request('search_name') }}"
                placeholder="Search our store"
                class="input-group-field input-text"
                aria-label="Search our store"
                onchange="document.getElementById('search').submit();"
                >
                <button type="submit">
                  <span class="ti-search"></span>
                </button>
              </form>
            </div>
          </div>
          <!-- Search Box End Here -->
          <!-- Cart Box Start Here -->

          <div class="col-md-3 col order-2 order-md-3 mb-sm-30">
            <div class="cart-box float-md-right">
              <div class="drodown-show">
                <a class="remove d-flex align-items-center">
                  <span class="total-pro">
                    <span class="bigcounter">
                      @if($carts && count($carts) > 0)
                          {{ count($carts) }}
                      @else
                          0
                      @endif
                    </span> item <br>
                  </span>
                </a>
                <ul class="dropdown cart-box-width">
                  @php $total = 0 @endphp
                  <li class="single-product-cart {{ count($carts) >= 1 ? 'd-block' : 'd-none' }}">
                    <div class="single-cart-item-loop">
                      @if($carts)
                        @foreach($carts as $item)
                        @php $total += $item->price* $item->quantity @endphp
                          <div class="single-cart-box">
                            <div class="cart-img">
                              <a href="{{ route('product-detail', $item->product_id) }}">
                                <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{$item->name}}">
                              </a>
                              <span class="pro-quantity">{{$item->quantity}}X</span>
                            </div>
                            <div class="cart-content">
                              <h6>
                                <a href="{{ route('product-detail', $item->product_id) }}">{{$item->name}}</a>
                              </h6>
                              <span class="cart-price">
                                <span class="money" data-currency-usd="${{$item->price}}">${{$item->price}}</span>
                              </span>
                            </div>
                            <form action="{{ route('remove-from-cart', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="del-icone"><span class="ti-close"></span></button>
                            </form>
                          </div>
                        @endforeach
                      @endif
                    </div>
                    <!-- Cart Footer Inner Start -->
                    <div class="cart-footer">
                      <ul class="price-content">
                        <li>Total: <span class="shopping-cart__total">
                            <span class="money" data-currency-usd="${{$total}}" data-currency-bdt="US {{$total}}" data-currency="BDT">US ${{number_format($total, 2)}}</span>
                          </span>
                        </li>
                      </ul>
                      <div class="cart-actions text-center d-flex justify-content-between">
                        <a class="cart-checkout" href="{{ route('cart')}}">Cart</a>
                        <a class="cart-checkout" href="{{ route('checkout')}}">Checkout</a>
                      </div>
                    </div>
                    <!-- Cart Footer Inner End -->
                  </li>
                  <li class="cart-tempty-title {{ count($carts) <= 0 ? 'd-block' : 'd-none' }}">
                    <h3>Your cart is currently empty.</h3>
                  </li>

                </ul>
              </div>
            </div>
          </div>
          <!-- Cart Box End Here -->
        </div>
      </div>
    </div>
    <div class="header-bottom blue-bg header-sticky">
      <div class="container">
        <div class="row align-items-center">
          <!-- Menu Area Start Here -->
          <div class="col-lg-10 d-none d-lg-block">
            <nav>
              <ul class="header-menu-list">
                <li class="active">
                  <a href="{{route('home-page')}}">Home </a>
                </li>
                <li class="">
                  <a class="drop-icon" href="#">Brands</a>
                  <!-- Home Version Dropdown Start -->
                  <ul class="ht-dropdown">
                    <li class="mega-menu-tree">
                      <ul>
                        <li>
                            <a href="{{route('product-shop')}}">All Brand</a>
                        </li>
                        @for ($i = 0; $i < min(4, count($brands)); $i++)
                          <li>
                              <a href="{{ url('/product-shop?brand_name=' . $brands[$i]->name) }}">
                                {{ $brands[$i]->name }}
                              </a>
                          </li>
                        @endfor
                      </ul>
                    </li>
                    <li class="mega-menu-tree">
                      <ul>
                        @for ($i = 4; $i < min(9, count($brands)); $i++)
                          <li>
                              <a href="{{ url('/product-shop?brand_name=' . $brands[$i]->name) }}">
                                {{ $brands[$i]->name }}
                              </a>
                          </li>
                        @endfor
                      </ul>
                    </li>
                    <li class="mega-menu-tree">
                      <ul>
                        @for ($i = 9; $i < min(14, count($brands)); $i++)
                          <li>
                              <a href="{{ url('/product-shop?brand_name=' . $brands[$i]->name) }}">
                                  {{ $brands[$i]->name }}
                              </a>
                          </li>
                        @endfor
                      </ul>
                    </li>
                  </ul>
                  <!-- Home Version Dropdown End -->
                </li>
                <li>
                  <a class="drop-icon">Accessaries</a>
                  <!-- Home Version Dropdown Start -->
                  <ul class="ht-dropdown">
                    <li class="mega-menu-tree">
                      <ul>
                          <li>
                              <a href="{{ url('/product-shop?accessary_name=') }}">All Accessaries</a>
                          </li>
                          @for ($i = 0; $i < min(4, count($accessaries_type)); $i++)
                              <li>
                                  <a href="{{ url('/product-shop?accessary_name=' . $accessaries_type[$i]->name) }}">
                                      {{ $accessaries_type[$i]->name }}
                                  </a>
                              </li>
                          @endfor
                      </ul>
                    </li>
                    <li class="mega-menu-tree">
                      <ul>
                          @for ($i = 4; $i < min(9, count($accessaries_type)); $i++)
                              <li>
                                  <a href="{{ url('/product-shop?accessary_name=' . $accessaries_type[$i]->name) }}">
                                      {{ $accessaries_type[$i]->name }}
                                  </a>
                              </li>
                          @endfor
                      </ul>
                    </li>
                    <li class="mega-menu-tree">
                      <ul>
                          @for ($i = 9; $i < min(14, count($accessaries_type)); $i++)
                              <li>
                                  <a href="{{ url('/product-shop?accessary_name=' . $accessaries_type[$i]->name) }}">
                                      {{ $accessaries_type[$i]->name }}
                                  </a>
                              </li>
                          @endfor
                      </ul>
                    </li>
                  </ul>
                  <!-- Home Version Dropdown End -->
                </li>
                <li class="">
                  <a class="drop-icon" href="#">Products</a>
                  <!-- Home Version Dropdown Start -->
                  <ul class="ht-dropdown">
                    <li>
                        <a href="{{ url('/product-shop') }}">All Products</a>
                    </li>
                    @foreach($products_type as $product_type)
                      <li>
                          <a href="{{ url('/product-shop') }}?product_type_name={{ $product_type->name }}">{{$product_type->name}}</a>
                      </li>
                    @endforeach
                  </ul>
                  <!-- Home Version Dropdown End -->
                </li>
                <li class="">
                  <a class="drop-icon" href="#">SecondHand</a>
                  <!-- Home Version Dropdown Start -->
                  <ul class="ht-dropdown">
                    <li>
                        <a href="{{ url('/product-shop') }}">All Products</a>
                    </li>
                    @foreach($products_type as $product_type)
                      <li>
                          <a href="{{ url('/product-shop') }}?product_type_name={{ $product_type->name }}">{{$product_type->name}}</a>
                      </li>
                    @endforeach
                  </ul>
                  <!-- Home Version Dropdown End -->
                </li>
                <li class="">
                  <a href="{{ route('blog') }}">Blog </a>
                </li>
                <li class="">
                  <a href="{{ route('contact') }}">contact</a>
                </li>

              </ul>
            </nav>
            <script>
              jQuery('.header-menu-list .mega-menu-tree').parent('ul').addClass('megamenu');
            </script>
          </div>
          <!-- Menu Area End Here -->
          <!-- Cart Box Start Here -->
          <div class="col-lg-2" style="padding-right: 6px">
            <div class="setting-box">
              <ul style="display: flex;justify-content: flex-end">
                <li class="{{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->id) ? 'd-none' : 'd-block' }}">
                  <a href="{{route('customer.login')}}" class="login-account d-flex">
                    <div class="circle">
                      <span class="ti-user"></span>
                    </div>
                    <span class="text-login-account">My Account <br> Register or Login</span>
                  </a>
                </li>
                <li class="drodown-show {{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->id) ? 'd-block' : 'd-none' }}">
                  <a href="">
                    @php
                        $user = Auth::guard('customer')->user();
                        $defaultImage = asset('assets/img/avatars/' .
                            ($user && $user->gender === 'female' ? 'female' : ($user && $user->gender === 'male' ? 'male' : 'other')) . '.jpg');
                        $imagePath = $user && isset($user->image) ? asset('uploads/users/' . $user->image) : $defaultImage;
                    @endphp
                    <div class="d-flex">
                      <img
                      width="40"
                      height="40"
                      src="{{ $imagePath }}"
                      class="w-px-40 h-auto rounded-circle" />
                      <span class="ml-2 title-user">Welcome <br>
                      <strong style="width: max-content;display: block;">
                        {{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->name) ? Auth::guard('customer')->user()->name  : '' }}
                      </strong>
                    </span>
                    </div>
                  </a>
                  <!-- Currency & Language Selection Start -->
                  <ul class="dropdown cart-box-width currency-selector">
                    <li>
                      <h3>My Account</h3>
                      <ul>
                        <li class="pt-2 pb-2">
                          <a href="{{route('my-order')}}">
                              <i class='bx bx-cart icon-circle'></i>My Order
                          </a>
                        </li>
                        <li class="pt-2 pb-2">
                          <a href="{{route('coupon')}}"> <i class='bx bxs-coupon icon-circle' ></i>My Coupon</a>
                        </li>
                        <li class="pt-2 pb-2">
                          <a href="{{route('favorite')}}"> <i class='bx bxs-heart icon-circle' ></i>Favorite</a>
                        </li>
                        <li class="pt-2 pb-2">
                          <a href="{{route('profile')}}"> <i class='bx bxs-user icon-circle'></i>Personal Information</a>
                        </li>
                        <li class="pt-2 pb-2">
                          <a href="{{route('change-password')}}"><i class='bx bx-lock-alt icon-circle'></i>Change Password</a>
                        </li>
                        <li class="pt-2 pb-2">
                          <a href="{{route('customer.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class='bx bx-log-out-circle icon-circle' ></i>Sign Out
                          </a>
                          <form id="logout-form" action="{{route('customer.logout')}}" method="POST" class="d-none"> @csrf @method('POST') </form>
                        </li>
                      </ul>
                    </li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- Cart Box End Here -->
        </div>
        <!-- Row End -->
        <!-- Mobile Menu Start Here -->
        <div class="mobile-menu d-block d-lg-none" data-menu="Menu">
          <nav>
            <ul>
              <li>
                <a href="{{route('home-page')}}">Home</a>
              </li>
              <li>
                <a class="drop-icon" href="#">Brands</a>
                <ul>
                  <li>
                    <a href="{{ url('/product-shop') }}?brand_id=">All Brand</a>
                  </li>
                  @foreach($brands as $brand)
                    <li>
                      <a href="{{ url('/product-shop') }}?brand_id={{ $brand->id }}">{{$brand->name}}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
              <li>
                <a class="drop-icon" href="#">Accessaries</a>
                <ul>
                  <li>
                    <a href="{{ url('/product-shop') }}?category_id=">All Accessaries</a>
                  </li>
                  @foreach($accessaries_type as $key => $accessary_type)
                    <li>
                        <a href="{{ url('/product-shop') }}?accessary_name={{$accessary_type->name }}">{{$accessary_type->name}}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
              <li class="">
                <a class="drop-icon" href="#">Products</a>
                <ul>
                  <li>
                      <a href="{{ url('/product-shop') }}?product_type_name=">All Products</a>
                  </li>
                  @foreach($products_type as $product_type)
                    <li>
                        <a href="{{ url('/product-shop') }}?product_type_name={{ $product_type->name }}">{{$product_type->name}}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
              <li class="">
                <a class="drop-icon" href="#">SecondHand</a>
                <ul>
                  <li>
                      <a href="{{ url('/product-shop') }}?product_type_params=">All Products</a>
                  </li>
                  @foreach($products_type as $product_type)
                    <li>
                        <a href="{{ url('/product-shop') }}?product_type_params={{ $product_type->id }}">{{$product_type->name}}</a>
                    </li>
                  @endforeach
                </ul>
              </li>
              <li class="">
                <a href="{{ route('blog') }}">Blog </a>
              </li>
              <li class="">
                <a href="{{ route('contact') }}">contact</a>
              </li>
            </ul>
          </nav>
        </div>
        <!-- Mobile Menu End Here -->
      </div>
      <!-- Container End -->
    </div>
  </header>
  <!-- Header Area End Here -->
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
<script>
    window.onload = function() {
      // IPinfo API URL with your token
      const apiUrl = 'https://ipinfo.io/111.90.186.31/json?token=19e0f77c0ad4f8';
  
      // Fetch the country code and flag via IPinfo.io API
      axios.get(apiUrl)
        .then(function(response) {
          // Get the country code from the response
          var countryCode = response.data.country;
  
          // Display the country code (e.g., 'US' for United States, 'FR' for France)
          var countryElement = document.getElementById('countryCode');
          countryElement.textContent = countryCode || 'Unknown';
  
          // Set the flag image URL based on the country code
          var flagElement = document.getElementById('countryFlag');
          if (countryCode) {
            flagElement.style.backgroundImage = `url('https://flagcdn.com/w20/${countryCode.toLowerCase()}.png')`;
          } else {
            flagElement.style.backgroundImage = 'none';
          }
        })
        .catch(function(error) {
          console.error("Error fetching geolocation data", error);
          document.getElementById('countryCode').textContent = 'Error'; // Fallback
        });
    };
  </script>
  
  
  