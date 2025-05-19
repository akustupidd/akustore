@extends('layout.web-app.app')
@section('title', $blog->title)
@section('content-web')

<main role="main">
    <div id="shopify-section-template--15048697413830__main" class="shopify-section">
        <div class="blog-area" id="section-template--15048697413830__main">
            <div class="container">
                <!-- Breadcrumb Navigation -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb custom-bread">
                        <li class="breadcrumb-item"><a href="{{route('home-page')}}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                    </ol>
                </nav>

                <div class="row">
                    <!-- Blog Content -->
                    <div class="col-lg-8 col-md-7">
                        <div class="blog-details">
                            <!-- Blog Media -->
                            <div class="blog-hero-img mb-40">
                                {{-- <img class="full-img" src="{{ asset('uploads/blogs/' . $blog->image) }}" alt="{{$blog->title}}"> --}}
                                @if($blog->cover_image)
                                <img  src="{{ asset($blog->cover_image) }}" class="img-fluid rounded">
                                @elseif($blog->video_url)
                                    <div class="video-container">
                                        <video controls>
                                            <source src="{{ asset($blog->video_url) }}" type="video/mp4">
                                        </video>
                                    </div>
                                @else
                                    <p>No Media</p>
                                @endif
                                <div class="entry-meta">
                                  <div class="date">
                                    <p class="mb-0 fw-bold">{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</p>
                                    <span class="small">{{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}</span>
                                  </div>
                                </div>
                            </div>
                            <div class="text-upper-portion">
                                <h3 class="blog-dtl-header portfolio-header">{{$blog->title}}</h3>
                                <ul class="meta-box meta-blog d-flex">
                                    <li class="meta-date">
                                        <span>
                                            <i class="fa fa-calendar"></i> {{ $blog->created_at->diffForHumans() }}
                                        </span>

                                    </li>
                                    <li>
                                        <i class="fa fa-user"></i> By <a href="#">{{ $blog->user_name ?? 'Admin' }}</a>
                                    </li>
                                </ul>
                                <!-- Blog Content -->
                                <div class="blog-content">{!! Purifier::clean($blog->content) !!}</div>
                            </div>
                        </div>

                        <!-- Comments Section -->
                        @include('web-page.blog.comments-section', ['comments' => $comments])
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4 col-md-5">
                        <div class="blog-sidebar">
                            <h3 class="sidebar-title">Custom Menu</h3>
                            <ul class="list-unstyled">
                                <li><a href="{{ route('home-page') }}">Home</a></li>
                                <li><a href="#">Brand</a></li>
                                <li><a href="#">Products</a></li>
                                <li><a href="#">SecondHand</a></li>
                                <li><a href="#">Categories</a></li>
                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                            </ul>

                            <!-- Recent Posts -->
                            @if($posts->isNotEmpty())
                                <h3 class="sidebar-title">Recent Posts</h3>
                                <div class="all-recent-post">
                                    @foreach($posts as $post)
                                        <div class="single-recent-post d-flex align-items-center">
                                            <div class="recent-img me-3">
                                                <a href="{{ route('blog-detail', $post->slug) }}">
                                                    @if($post->cover_image)
                                                        <img src="{{ asset($post->cover_image) }}"
                                                            alt="blog image"
                                                            class="img-fluid rounded"
                                                            style="width: 100px; height: 88px; object-fit: cover;">
                                                    @elseif($post->video_url)
                                                        <video width="100" height="88" controls style="object-fit: cover;">
                                                            <source src="{{ asset($post->video_url) }}" type="video/mp4">
                                                        </video>
                                                    @else
                                                        <span class="text-muted">No Media</span>
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="recent-desc">
                                                <h6>
                                                    <a href="{{ route('blog-detail', $post->slug) }}" class="text-dark text-decoration-none">
                                                        {{ $post->title }}
                                                    </a>
                                                </h6>
                                                <span class="text-muted small">
                                                    <i class="fa fa-calendar me-1"></i>
                                                    {{ $post->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".reply-btn").forEach(button => {
            button.addEventListener("click", function() {
                let commentId = this.getAttribute("data-comment-id");
                let username = this.getAttribute("data-username");

                // Set parent_id in hidden field
                document.getElementById("parent_id").value = commentId;

                // Autofill textarea with mention
                let textarea = document.getElementById("comment-textarea");
                textarea.value = `@${username} `;
                textarea.focus();
            });
        });
    });
</script>

@endsection
