@extends('layout.web-app.app')   
@section('title') {{'Contact Us'}} @endsection
@section('content-web')

<main role="main">
  

  <div id="shopify-section-template--15048369176774__main" class="shopify-section">
   
     <!-- Regester Page Start Here -->
     <div class="register-area" id="section-template--15048369176774__main">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-bread">
            <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('product-shop')}}">Product</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
          </ol>
        </nav>
        <h3 class="login-header text-left text-primary">@yield('title')</h3>
        <div class="row">
          <div class="col-12 col-md-6">
            <div class="mb-4">
              <h1>សូមស្វាគមន៍</h1>
              <h2>បើលោកអ្នកមានបញ្ហា ឬ មានសំនួរ លោកអ្នកអាចទាក់ទងមកកាន់លេខទូរស័ព្ទខាងក្រោមនេះ៖</h2>
              <h2>086 608 237</h2>
              <h2>088 722 8833</h2>
              <h2>096766 0332</h2>
            </div>
            <div class="mb-3">
              <img src="../../assets-web/images/customer_service_generated.jpg" alt="customer_service_generated">
            </div>
          </div>
          <div class="col-12 col-md-6">
            <div class="px-4 py-4 bg-fill rounded-lg">
              <h5 class="text-primary py-3" style="line-height: 30px;"> 
                if you have any questions or inquiries, fell free to use this from and we will get back to you as soon as possible 
              </h5>
              <form action="#" class="mt-3" id="question-form" method="POST">
                <div class="form-group">
                  <label for="name" class="">Name</label>
                  <div class="password-toggle">
                    <input type="text" name="name" value="" placeholder="Name" class="form-control ">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="">Email</label>
                  <div class="password-toggle">
                    <input type="email" name="email" value="" placeholder="Email" class="form-control ">
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone_number" class="">Phone Number</label>
                  <div class="password-toggle">
                    <input type="text" name="phone_number" value="" placeholder="Phone Number" class="form-control ">
                  </div>
                </div>
                <div class="form-group">
                  <label for="subject" class="">Subject</label>
                  <div class="password-toggle">
                    <input type="text" name="subject" value="" placeholder="Subject" class="form-control ">
                  </div>
                </div>
                <label>Message</label>
                <textarea name="message" class="form-control " placeholder="Message" rows="4"></textarea>
                <div class="d-flex flex-wrap justify-content-center align-items-center mt-4">
                  <button type="submit" class="btn btn-primary mt-3 mt-sm-0 px-5 text-uppercase">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Register Page End Here -->
    <!-- Google Map Start -->
    <div class="goole-map">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3994232.412031844!2d102.341095997094!3d12.138296527994648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310787bfd4dc3743%3A0xe4b7bfe089f41253!2sCambodia!5e0!3m2!1sen!2skh!4v1737343822413!5m2!1sen!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
   
    <style></style>
  </div>
</main>

@endsection