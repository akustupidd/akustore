@extends('layout.web-app.app')   
@section('title') {{'404 Not Found'}} @endsection
@section('content-web')
    <style>
        .error-image {
            max-width: 100%; /* Ensure responsiveness */
            width: 470px; /* Set a consistent width */
            height: auto; /* Maintain aspect ratio */
            display: block;
            margin: 0 auto; /* Center the image */
        }

    </style>
    <main role="main">
        <div id="shopify-section-template--15048369176774__main" class="shopify-section">
            <div class="policy-area" id="section-template--15048369176774__main">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb custom-bread">
                        <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="error-content text-center">
                            
                                <img src="{{asset('assets-web/images/errors/404_error.webp')}}" alt="Error 500" class="error-image">
                            
                            
                            <h4>Ooops! Error 404</h4>
                            
                            
                            <p>Sorry, But the page you are looking for does't exist!</p>
                            
                            
                            <a class="theme-default-button" href="{{ url('/') }}" data-text="Go to home page">Go to home page</a>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection