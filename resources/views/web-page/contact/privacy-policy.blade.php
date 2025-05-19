@extends('layout.web-app.app')   
@section('title') {{'Privacy Policy'}} @endsection
@section('content-web')

<main role="main">
  <div id="shopify-section-template--15048369176774__main" class="shopify-section">
    <!-- Privacy Policy Page Start -->
    <div class="policy-area" id="section-template--15048369176774__main">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb custom-bread">
            <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
          </ol>
        </nav>
        <h3 class="login-header text-left text-primary">@yield('title')</h3>
        <div class="row">
          <div class="col-12">
            <div class="bg-fill rounded-lg px-4 py-4">
              <h4 class="text-primary py-3">Effective Date: [Insert Date]</h4>
              <p>
                Welcome to <strong>store.akushoping.com</strong> ("we", "our", or "us"). Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you interact with our website <a href="{{route('home-page')}}">https://store.akushoping.com</a>.
              </p>

              <h5 class="text-primary mt-4">Information We Collect</h5>
              <ul>
                <li><strong>Personal Information:</strong> Name, email address, phone number, shipping and billing addresses, and payment details.</li>
                <li><strong>Non-Personal Information:</strong> Browser type, IP address, device information, and interaction details.</li>
                <li><strong>Cookies:</strong> Small files stored on your device to enhance your browsing experience.</li>
              </ul>

              <h5 class="text-primary mt-4">How We Use Your Information</h5>
              <p>We use the information we collect to:</p>
              <ul>
                <li>Process and fulfill your orders.</li>
                <li>Provide customer support and manage your account.</li>
                <li>Send updates and promotional offers (you can opt-out anytime).</li>
                <li>Analyze and improve our services.</li>
                <li>Ensure the security of your data and prevent fraud.</li>
              </ul>

              <h5 class="text-primary mt-4">How We Protect Your Information</h5>
              <p>
                We implement secure data transmission (HTTPS), encryption, and restricted access to protect your information.
                While we take every precaution, no system is completely secure, and you acknowledge this inherent risk.
              </p>

              <h5 class="text-primary mt-4">Your Rights</h5>
              <p>You have the right to:</p>
              <ul>
                <li>Access and correct your personal information.</li>
                <li>Request data deletion (subject to legal obligations).</li>
                <li>Unsubscribe from marketing communications.</li>
              </ul>
              <p>Contact us at <a href="mailto:support@store.akushoping.com">support@store.akushoping.com</a> to exercise these rights.</p>

              <h5 class="text-primary mt-4">Changes to This Privacy Policy</h5>
              <p>
                We may update this policy periodically. Updates will be posted on this page with the updated effective date.
              </p>

              <h5 class="text-primary mt-4">Contact Us</h5>
              <p>
                If you have any questions, please contact us at:
                <br>
                <strong>Email:</strong> <a href="mailto:support@store.akushoping.com">support@store.akushoping.com</a>
                <br>
                <strong>Website:</strong> <a href="{{route('home-page')}}">https://store.akushoping.com</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Privacy Policy Page End -->

    <!-- Google Map Start -->
    <div class="goole-map mt-5">
      <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3994232.412031844!2d102.341095997094!3d12.138296527994648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310787bfd4dc3743%3A0xe4b7bfe089f41253!2sCambodia!5e0!3m2!1sen!2skh!4v1737343822413!5m2!1sen!2skh" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <!-- Google Map End -->
  </div>
</main>

@endsection
