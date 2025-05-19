<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="{{ route('dashboard') }}" class="app-brand-link d-flex">
      <span class="app-brand-logo demo">
       <img src="{{asset('assets-web/images/dark 1.png')}}" width="150"/>
      </span>
      {{-- <span class="app-brand-text demo menu-text fw-bolder ms-2" style="text-transform: capitalize;"></span> --}}
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item {{ Route::currentRouteName() == 'dashboad' ? 'active' : '' }}">
      <a href="{{ route('dashboard') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-dashboard"></i>
        <div data-i18n="Dashboard">Dashboard</div>
      </a>
    </li>

    <!-- Layouts -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Mangae Type Product</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'accessaries' ? 'active' : '' }}">
      <a href="{{ route('accessaries') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-pyramid"></i>
        <div data-i18n="accessaries">Accessaries</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'brand' ? 'active' : '' }}">
      <a href="{{ route('brand') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-mobile-vibration"></i>
        <div data-i18n="Brands">Brands</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'category' ? 'active' : '' }}">
      <a href="{{ route('category') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-label"></i>
        <div data-i18n="Categories">Categories</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase ">
      <span class="menu-header-text">Banners</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'banner' ? 'active' : '' }}">
      <a href="{{ route('banner') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-carousel"></i>
        <div data-i18n="Slide Banner">Slide Banner</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Manage Blog</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'blog-ad' ? 'active' : '' }}">
      <a href="{{ route('blog-ad') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-book-open"></i>
        <div data-i18n="Feature Center">Blog</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Manage Stock</span>
    </li>
    <li class="menu-item  {{ Route::currentRouteName() == 'stock' ? 'active' : '' }}">
      <a href="{{ route('stock') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-store"></i>
        <div data-i18n="stock">Stock</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Manage Products</span>
    </li>
    <li class="menu-item  {{ Route::currentRouteName() == 'product' ? 'active' : '' }}">
      <a href="{{ route('product') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-data"></i>
        <div data-i18n="Products">Products</div>
      </a>
    </li>
    <li class="menu-item  {{ Route::currentRouteName() == 'product-type' ? 'active' : '' }}">
      <a href="{{ route('product-type') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-food-menu"></i>
        <div data-i18n="Product Type">Product Type</div>
      </a>
    </li>
    {{-- <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Products Feature</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'specification' ? 'active' : '' }}">
      <a href="{{ route('specification') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
        <div data-i18n="Products">Specification</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'soft-info' ? 'active' : '' }}">
      <a href="{{ route('soft-info') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-detail"></i>
        <div data-i18n="softinfo">Soft Info</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'ram' ? 'active' : '' }}">
      <a href="{{ route('ram') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-hdd"></i>
        <div data-i18n="Ram">Ram</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'storage' ? 'active' : '' }}">
      <a href="{{ route('storage') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-memory-card"></i>
        <div data-i18n="Storage">Storage</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'color' ? 'active' : '' }}">
      <a href="{{ route('color') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-color-fill"></i>
        <div data-i18n="Color">Color</div>
      </a>
    </li> --}}
    <li class="menu-item {{ Route::currentRouteName() == 'admin-coupon' ? 'active' : '' }}">
      <a href="{{ route('admin-coupon') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-coupon"></i>
        <div data-i18n="admin-coupon">Coupon</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Report</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'report-stock' ? 'active' : '' }}">
      <a href="{{ route('report-stock') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-food-menu"></i>
        <div data-i18n="admin-coupon">Report Stock</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'report-sale' ? 'active' : '' }}">
      <a href="{{ route('report-sale') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-dollar-circle"></i>
        <div data-i18n="report-sale">Report Sale</div>
      </a>
    </li>
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Account Setting</span>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'client' ? 'active' : '' }}">
      <a href="{{ route('client') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="client">Customers</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'user' ? 'active' : '' }}">
      <a href="{{ route('user') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="user">User</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'role' ? 'active' : '' }}">
      <a href="{{ route('role') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-lock-open"></i>
        <div data-i18n="role">Role</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'permission' ? 'active' : '' }}">
      <a href="{{ route('permission') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-brightness"></i>
        <div data-i18n="permission">Permission</div>
      </a>
    </li>
    <li class="menu-item {{ Route::currentRouteName() == 'account' ? 'active' : '' }}">
      <a href="{{ route('account') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bxs-user-detail"></i>
        <div data-i18n="account">Account</div>
      </a>
    </li>
  </ul>
</aside>
<!-- / Menu -->
