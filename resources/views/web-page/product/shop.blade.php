@extends('layout.web-app.app')
@section('title') {{'Product Shop'}} @endsection
@section('content-web')
<style>
.sidebar-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    font-size: 1.2em;
    font-weight: bold;
    margin-bottom: 0.5em;
}

.toggle-icon {
    font-size: 1em;
    margin-left: 10px;
    transition: transform 0.3s ease;
}

.toggle-icon.collapsed {
    transform: rotate(0deg);
}

.toggle-icon.expanded {
    transform: rotate(180deg);
}
.row-brand {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping */
    justify-content: space-between; /* Space between items */
}

.row-brand img {
    max-width: 100%; /* Ensure images fit within their container */
    height: auto;
    display: block;
    margin: 0 auto;
}

.col-lg-6, .col-3 {
    width: 50%; /* Each brand item takes up half the width */
    padding: 10px; /* Add some spacing */
    box-sizing: border-box; /* Include padding in the width calculation */
}

@media (max-width: 768px) {
    .col-lg-6, .col-3 {
        width: 100%; /* On smaller screens, make it a single column */
    }
}
.selected-filters-list {
    display: flex;
    flex-wrap: wrap; /* Allow wrapping to the next line */
    gap: 10px; /* Add spacing between tags */
    padding: 0;
    margin: 0;
    list-style: none; /* Remove default list styles */
}

.selected-filters-list li {
    display: inline-flex;
    align-items: center;
    padding: 5px 10px;
    background-color: #f8f9fa; /* Light gray background for tags */
    border: 1px solid #ddd; /* Optional border */
    border-radius: 20px;
    font-size: 14px;
}

.selected-filters-list li .remove-filter {
    margin-left: 5px; /* Spacing between text and ✖ */
    color: #dc3545; /* Red color for remove icon */
    text-decoration: none;
    font-weight: bold;
}

.selected-filters-list li .remove-filter:hover {
    color: #ff0000; /* Hover effect for the remove icon */
}
.selected-filters-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-bottom: 20px; /* Space below the filters */
}

</style>

<main role="main">
  <div id="shopify-section-template--15048369012934__main" class="shopify-section">
    <!-- Start Shop Page -->
    <div class="main-shop-page" id="section-template--15048369012934__main">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-bread">
            <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('product-shop')}}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
          </ol>
        </nav>
        <div class="row">
            <div class="col-lg-3 col-12">
                <div class="shop-sidebar">
                     <!-- Selected Filters -->
                     <div class="selected-filters-container">
                        <ul class="selected-filters-list">
                            @if(request()->has('product_type_name'))
                                @foreach(request()->get('product_type_name', []) as $index => $selectedType)
                                    <li>
                                        {{ $selectedType }}
                                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('product_type_name'), ['product_type_name' => array_diff(request()->get('product_type_name'), [$selectedType])])) }}" class="remove-filter">✖</a>
                                    </li>
                                @endforeach
                            @endif
                            @if(request()->has('brand_name'))
                                <li>
                                    {{ request('brand_name') }}
                                    <a href="{{ url()->current() . '?' . http_build_query(request()->except('brand_name')) }}" class="remove-filter">✖</a>
                                </li>
                            @endif
                            @if(request()->has('category_name'))
                                @foreach(request()->get('category_name', []) as $index => $selectedCategory)
                                    <li>
                                        {{ $selectedCategory }}
                                        <a href="{{ url()->current() . '?' . http_build_query(array_merge(request()->except('category_name'), ['category_name' => array_diff(request()->get('category_name'), [$selectedCategory])])) }}" class="remove-filter">✖</a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        @if(request()->has('product_type_name') || request()->has('brand_name') || request()->has('category_name'))
                            <a href="{{ url()->current() }}" class="btn btn-danger btn-sm mt-2">Clear All</a>
                        @endif
                    </div>
                    <!-- Product Type Filter -->
                    <div class="sidebar-categorie mb-30 sidebar-widget">
                        <h3 class="sidebar-title widget-collapse-show" onclick="toggleContent(this)">Product type</h3>
                        <form method="GET" id="productTypeForm" action="{{ url('/product-shop') }}">
                            <ul class="sidbar-style">
                                @foreach($products_type as $product_type)
                                    <li>
                                        <input
                                            type="checkbox"
                                            name="product_type_name[]"
                                            value="{{ $product_type->name }}"
                                            id="{{ $product_type->name }}"
                                            {{ in_array($product_type->name, request()->get('product_type_name', [])) ? 'checked' : '' }}>
                                        <label for="{{ $product_type->name }}">{{ $product_type->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                        </form>
                    </div>

                    <!-- Brand Filter -->
                    <div class="sidebar-categorie mb-30 sidebar-widget">
                        <h3 class="sidebar-title" onclick="toggleContent1(this)">Brand</h3>
                        <div class="row row-brand toggle-content">
                            @foreach($brands as $brand)
                                <div class="col-lg-6 col-3">
                                    <a href="{{ url('/product-shop') }}?brand_name={{ $brand->name }}" class="link-to-brand">
                                        <img src="{{ asset('uploads/brands/' . $brand->image) }}" alt="{{ $brand->name }}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Categories Filter -->
                    <div class="sidebar-categorie mb-30 sidebar-widget">
                        <h3 class="sidebar-title" onclick="toggleContent(this)">Categories</h3>
                        <form method="GET" name="category_name" id="categoryForm" action="{{ url('/product-shop') }}">
                            <ul class="sidbar-style">
                                @foreach($categories as $category)
                                    <li>
                                        <input
                                            type="checkbox"
                                            name="category_name[]"
                                            value="{{ $category->name }}"
                                            id="{{ $category->name }}"
                                            {{ in_array($category->name, request()->get('category_name', [])) ? 'checked' : '' }}>
                                        <label for="{{ $category->name }}">{{ $category->name }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <button type="submit" class="btn btn-primary mt-3">Apply Filters</button>
                        </form>
                    </div>

                </div>
            </div>
          <div class="col-lg-9 col-12">
            <div class="row">
              <div class="col-lg-12">
                <!-- Grid & List View Start -->
                <div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                  <div class="dataTables_length" id="add-row_length">
                    <label for="SortBy">
                      <select id="add_row_length" name="add_row_length" class="select-length form-control form-control-sm">
                        <option value="10" {{ request('row_length') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('row_length') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('row_length') == 50 ? 'selected' : '' }}>50</option>
                        <option value="all" {{ request('row_length') == 'all' ? 'selected' : '' }}>All</option>
                      </select>
                    </label>
                    <script>
                        document.getElementById('add_row_length').addEventListener('change', function() {
                            let value = this.value;
                            let url = new URL(window.location.href);
                            url.searchParams.set('row_length', value);
                            window.location.href = url.toString();
                        });
                    </script>
                  </div>
                  <div class="main-toolbar-sorter clearfix">
                    <div class="toolbar-sorter d-md-flex align-items-center short-list">
                      <label for="SortBy">Sort by</label>
                      <select name="sort_by" id="SortBy" class="sorter wide">
                        <option value="">Default</option>
                        <option value="title-ascending" {{request('sort_by') == "title-ascending" ? 'selected' : '' }}>Alphabetically, A-Z</option>
                        <option value="title-descending" {{request('sort_by') == 'title-descending' ? 'selected' : '' }}>Alphabetically, Z-A</option>
                        <option value="price-ascending" {{request('sort_by') == 'price-ascending' ? 'selected' : '' }}>Price, low to high</option>
                        <option value="price-descending" {{request('sort_by') == 'price-descending' ? 'selected' : '' }}>Price, high to low</option>
                      </select>
                      <script>
                        document.getElementById('SortBy').addEventListener('change', function() {
                            let value = this.value;
                            let url = new URL(window.location.href);
                            url.searchParams.set('sort_by', value);
                            window.location.href = url.toString();
                        });
                      </script>
                    </div>
                  </div>
                </div>
                <!-- Grid & List View End -->
              </div>
            </div>
            <div class="shop-area mb-all-40">
              <div class="tab-content">
                @if ($noProductsMessage)
                  <div class="alert alert-warning">
                      {{ $noProductsMessage }}
                  </div>
                @else
                <div id="grid-view">
                  <div class="row border-hover-effect">
                    @foreach($products as $product)
                      <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="single-ponno-product">
                          <div class="pro-img">
                            <a href="{{ route('product-detail', ['slug' => $product->slug]) }}">
                              <img class="primary-img popup_cart_image" src="{{ asset('uploads/products/'. $product->image)}}" alt="{{$product->name}}">
                            </a>
                            <div class="pro-actions-link">
                              <a href="#" class="compare" data-pid="{{$product->slug}}" title="Compare" data-toggle="tooltip" data-original-title="Compare" data-placement="left">
                                <i class="icon icon-MusicMixer"></i>
                              </a>
                              <a href="javascript:void(0);" class="action-btn quick-view" onclick="quiqview('{{$product->slug}}')" data-toggle="modal" data-target="#quickViewModal" title="Quick View">
                                <span class="icon icon-Eye"></span>
                              </a>
                            </div>
                            <a class="action-wishlist action--wishlist tile-actions--btn flex wishlist-btn wishlist sticker-new" href="{{ route('favorite-add', $product->id) }}" title="Wishlist">
                                <i class="ti-heart"></i>
                            </a>
                          </div>
                          <div class="pro-content">
                            <div class="pro-info">
                              <h4 class="popup_cart_title">
                                <a href="{{route('product-detail', ['slug' => $product->slug])}}">{{$product->name}}</a>
                              </h4>
                              <p>
                                <span class="special-price">
                                  <span class="money">${{ $product->stock ? number_format($product->stock->price, 2) : 'N/A' }}</span>
                                </span>
                                @if($product->discount_price)
                                  <span class="special-price-old">
                                    <span class="money">${{$product->discount_price}}</span>
                                  </span>
                                @endif
                              </p>
                              <div class="product-rating">
                                <span class="shopify-product-reviews-badge" data-id="1488429252675"></span>
                              </div>
                            </div>
                          </div>
                          <div class="pro-add-cart">
                            <a href="{{ route('cart.add', $product->id)  }}" class="action-btn" title="Add to cart">
                              <span class="addto">Add To Cart</span>
                            </a>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                </div>
                <div class="shop-breadcrumb-area border-default">
                    <div class="row">
                        <div class="col-lg-12 pagination-shop-product">
                            @if($isPaginated)
                                <div class="pagination-wrapper overflow-auto">
                                    <nav aria-label="Page navigation">
                                        {{ $products->onEachSide(1)->links() }}
                                    </nav>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Shop Page -->
  </div>
</main>
<script>
function toggleContent(element) {
    const content = element.nextElementSibling; // Select the sibling content (form or div)
    const icon = element.querySelector('.toggle-icon'); // Optional: Add an icon if needed

    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        if (icon) {
            icon.classList.remove('collapsed');
            icon.classList.add('expanded');
        }
    } else {
        content.style.display = 'none';
        if (icon) {
            icon.classList.remove('expanded');
            icon.classList.add('collapsed');
        }
    }
}
function toggleContent1(element) {
    const content = element.nextElementSibling; // Get the next sibling (the content)
    const icon = element.querySelector(".toggle-icon"); // Get the toggle icon
    if (content.classList.contains("toggle-content")) {
        content.style.display = content.style.display === "none" ? "flex" : "none";
        icon.textContent = content.style.display === "none" ? "˅" : "˄";
    }
}
  // More precise selector to hide only the summary text
  document.querySelectorAll("nav p.text-sm.text-gray-700.leading-5").forEach(el => {
                            el.style.display = "none";
                        });
</script>
@endsection
