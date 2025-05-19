@extends('layout.web-app.app')   
@section('title', 'Blog')
@section('content-web')

<main role="main">
    <div id="shopify-section-template--15048697413830__main" class="shopify-section">
        <div class="blog-area" id="section-template--15048697413830__main">
            <div class="container">

                <!-- Breadcrumb Navigation -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom-bread">
                        <li class="breadcrumb-item"><a href="{{ route('home-page') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('product-shop') }}">Product</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>

                <!-- Section Title -->
                <div class="text-center mb-4">
                    <h2 class="section-title">Latest Blog Posts</h2>
                </div>

                <!-- Unified Row for Search and Categories -->
                <div class="row mb-4 align-items-center">
                    <!-- Blog Categories -->
                    <div class="col-md-6">
                        <div class="blog-categories">
                            <form action="{{ route('blog') }}" method="get">
                                <div class="input-group">
                                    <select class="form-select" name="blog_category" onchange="this.form.submit()">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $selectedCategory == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Search Form -->
                    <div class="col-md-6 text-end">
                        <form action="{{ route('blog') }}" method="get">
                            <div class="input-group">
                                <input type="hidden" name="blog_category" value="{{ $selectedCategory }}">
                                <input type="text" class="form-control" name="search" placeholder="Search blogs..." value="{{ request()->get('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-search"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                @if ($fallbackSearch && !$blogs->isEmpty())
                <div class="alert alert-warning text-center">
                    No results found in the selected category. Searching across all categories instead.
                </div>
            @endif
            
            @if ($blogs->isEmpty())
                <div class="alert alert-danger text-center">
                    No blogs found. Try searching with different keywords.
                </div>
            @else
                <div class="row">
                    @forelse($blogs as $key => $blog)
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Blog Start -->
                            <div class="single-elomus-blog shadow-sm rounded">
                                <div class="blog-img position-relative">
                                    <a href="{{ route('blog-detail', $blog->slug) }}">
                                        @if($blog->cover_image) 
                                            <img src="{{ asset(ltrim($blog->cover_image, '/')) }}" 
                                                 alt="blog image" class="img-fluid rounded"
                                                 style="width: 100%; height: 250px; object-fit: cover;">
                                        @elseif($blog->video_url)
                                            <video width="100%" height="250" controls>
                                                <source src="{{ asset('storage/' . ltrim($blog->video_url, 'public/')) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @else
                                            <span class="text-muted">No Media</span>
                                        @endif
                                    </a>
                                    <div class="entry-meta position-absolute">
                                        <div class="date text-black text-center">
                                            <p class="mb-0 fw-bold">{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</p>
                                            <span class="small">{{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-content p-3">
                                    <h4 class="mb-2">
                                        <a href="{{ route('blog-detail', $blog->slug) }}" class="text-dark text-decoration-none">
                                            {{ $blog->title }}
                                        </a>
                                    </h4>
                                    <ul class="meta-box list-unstyled d-flex gap-3 small text-muted">
                                        <li class="meta-date">
                                            <i class="fa fa-calendar me-1"></i> 
                                            {{ $blog->created_at->diffForHumans() }}
                                        </li>
                                        <li>
                                            <i class="fa fa-user me-1"></i> By {{ $blog->user_name ?? 'Admin' }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Single Blog End -->
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p class="text-muted">No blog posts available.</p>
                        </div>
                    @endforelse
                    @endif
                </div>

                <!-- Pagination -->
                @if ($blogs->hasPages())
                <div class="shop-breadcrumb-area border-default mt-4">
                    <div class="row">
                        <div class="col-lg-12 pagination-shop-product">
                            <div class="theme-default-pagination d-flex justify-content-center overflow-auto">
                                {{ $blogs->onEachSide(1)->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        // Remove link from disabled and active pagination items
                        document.querySelectorAll(".theme-default-pagination .disabled a, .theme-default-pagination li.active a").forEach(el => {
                            el.removeAttribute("href");
                        });
                
                        // More precise selector to hide only the summary text
                        document.querySelectorAll("nav p.text-sm.text-gray-700.leading-5").forEach(el => {
                            el.style.display = "none";
                        });
                    });
                </script>
                
            @endif
            

            </div>
        </div>
    </div>
</main>
@endsection
