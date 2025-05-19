<!doctype html>
<html class="no-js supports-no-cookies" lang="en"> <!--<![endif]-->
<head>
  <!-- Basic and Helper page needs -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0438a1">
  <link rel="icon" type="image/x-icon" href="{{ asset('l.ico') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
  <title>Lawliet Store | @yield('title')</title>
  <meta property="og:type" content="website">
  <meta property="og:title" content="Lawliet Store - eCommerce By Aku Air Div">
  <meta property="og:description" content="">
  <meta property="og:site_name" content="Lawliet Store - eCommerce By Aku Air Div">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="Lawliet Store - eCommerce By Aku Air Div">
  <meta name="twitter:description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- CSS -->
  <link href="{{ asset('assets-web/assets/timber.scss.css') }}" rel="stylesheet" type="text/css" media="all" />
  {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}
  <link href="{{ asset('assets-web/assets/font-awesome.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/animate.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/themify-icons.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/stroke-gap.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/material-design-iconic-font.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/jquery.fancybox.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/meanmenu.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/slick.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/bootstrap.min.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/default.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/style.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/responsive.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/theme-default.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/custom.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/theme-responsive.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/skin-theme.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/theme-color.css') }}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{ asset('assets-web/assets/custom-style.css') }}" rel="stylesheet" type="text/css" media="all" />
  <!-- sweet alert  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Header hook for plugins -->
 <!-- boxicon -->
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <script integrity="sha256-n5Uet9jVOXPHGd4hH4B9Y6+BxkTluaaucmYaxAjUcvY=" data-source-attribution="shopify.loadfeatures" defer="defer" src="//ponno-demo.myshopify.com/cdn/shopifycloud/shopify/assets/storefront/load_feature-9f951eb7d8d53973c719de211f807d63af81c644e5b9a6ae72661ac408d472f6.js" crossorigin="anonymous"></script>
  <script integrity="sha256-HAs5a9TQVLlKuuHrahvWuke+s1UlxXohfHeoYv8G2D8=" data-source-attribution="shopify.dynamic-checkout" defer="defer" src="//ponno-demo.myshopify.com/cdn/shopifycloud/shopify/assets/storefront/features-1c0b396bd4d054b94abae1eb6a1bd6ba47beb35525c57a217c77a862ff06d83f.js" crossorigin="anonymous"></script>
  <script integrity="sha256-o0rXHoHYF8JV/pI5sd/RPjI3ywH41Ezq5yxQ3ds5iuM=" defer="defer" src="//ponno-demo.myshopify.com/cdn/shopifycloud/shopify/assets/storefront/bars/preview_bar_injector-a34ad71e81d817c255fe9239b1dfd13e3237cb01f8d44ceae72c50dddb398ae3.js" crossorigin="anonymous"></script>
  <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
  <script src="{{ asset('assets-web/assets/modernizr-3.5.0.min.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  {{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') }}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
  {{-- <script src="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') }}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('assets-web/assets/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/jquery-migrate-v1.4.1.js') }}"></script>
  <script src="{{ asset('assets-web/assets/jquery.meanmenu.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/jquery.scrollUp.js') }}"></script>
  <script src="{{ asset('assets-web/assets/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/slick.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/popper.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets-web/assets/plugins.js') }}"></script>
  <!-- Ajax Cart js -->
  <script src="{{ asset('assets-web/assets/theme.js') }}"></script>
<!-- Loader CSS -->
<style>
  .loader-logo {
      width: 40px; /* Similar to Facebook footer logo */
      height: auto;
      animation: fadeInOut 1s infinite;
  }

  @keyframes fadeInOut {
      0%, 100% {
          opacity: 0.5;
      }
      50% {
          opacity: 1;
      }
  }
</style>
</head>
<body id="ponno-ecommerce-shopify-theme" class="template-index" >
  {{-- <form method="post" action="/contact#Contact_" id="Contact_" accept-charset="UTF-8" class="contact-form">
    <input type="hidden" name="form_type" value="customer">
    <input type="hidden" name="utf8" value="✓">
    <div id="one-time-newsletter" class="popup_wrapper" style="opacity: 1; visibility: visible; transition: all 0.5s ease 0s;">
      <div class="newsletter_popup_inner">
          <span class="popup_off"><i class="fa fa-times"></i></span>
          <div class="subscribe_area">
            <h2 class="">Newsletter</h2>
            <p class="">Join over 1,000 people who get free and fresh content delivered automatically each time we publish</p>
            <div class="form-group subscribe-form-group"><div class="">
                <input type="hidden" name="contact[tags]" value="newsletter">
                <input class="form-control subscribe-form-input" type="email" name="contact[email]" id="Email" value="" placeholder="email@example.com" aria-label="email@example.com" autocorrect="off" autocapitalize="off">
                <button type="submit" class="newsletter-btn" name="commit" id="Subscribe">Subscribe</button><p><input id="forgetMe" type="checkbox" name="forgetMe">Don't show this again</p></div>
            </div>
          </div>
      </div>
    </div>
  </form> --}}
    <x-web-header />
  <div id="main-content">
  @yield('content-web') 
  </div>
    @include('layout.web-app.footer')
</body>
<script src="{{ asset('assets-web/assets/fastclick.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets-web/assets/timber.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets-web/assets/wishlist.js')}}" defer="defer"></script>
<script src="{{ asset('assets-web/assets/app.min.js')}}" typet="text/javascript"></script>
<script src="{{ asset('assets-web/assets/custom2.js')}}" type="text/javascript"></script>

<!-- message success  -->
@if (Session::has('message'))
    <script>
        swal({
            title: "Message",
            text: "{{ Session::get('message') }}",
            icon: "success",
            buttons: true,
            timer: 2500,
            dangerMode: false,
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        swal({
            title: "Error",
            text: "{{ Session::get('error') }}",
            icon: "error",
            buttons: true,
            timer: 2500,
            dangerMode: true,
        });
    </script>
@endif
@if (Session::has('warning'))
    <script>
        swal({
            title: "Warning",
            text: "{{ Session::get('warning') }}",
            icon: "warning",
            buttons: true,
            timer: 2500,
            dangerMode: false,
        });
    </script>
@endif

<!-- wirning message  -->
<script type="text/javascript">
// with a href
  function confirmation(ev) {
      ev.preventDefault();
      var urlToRedirect = ev.currentTarget.getAttribute('href');
      console.log(urlToRedirect);
      swal({
          title: "Are you soure to delete this?",
          text: "You won't be able to revert this delete" ,
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willCancel) => {
          if (willCancel) {
              window.location.href = urlToRedirect;
          }
      })
  }
// with buttons submit
  function confirmationform(ev) {
    ev.preventDefault(); // Prevent the default form submission
    var form = ev.target; // Get the form element

    swal({
        title: "Are you sure you want to delete this?",
        text: "You won't be able to revert this delete",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            form.submit(); // Submit the form if confirmed
        }
    });
    return false; // Prevent default action for older browsers
  }
</script>


<div id="shopify-section-recommended" class="shopify-section"></div>
</html>

