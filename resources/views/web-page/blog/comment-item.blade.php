<div class="single-comment d-flex align-items-start mb-3">
    <div class="comment-img me-3">
        @php
            $defaultImage = asset('assets/img/avatars/' . ($comment->customer->gender === 'female' ? 'female' : 'male') . '.jpg');
            $imagePath = $comment->customer->image ? asset('uploads/users/' . $comment->customer->image) : $defaultImage;
        @endphp
        <img src="{{ $imagePath }}" alt="user avatar" class="rounded-circle"
             style="width: 50px; height: 50px; object-fit: cover;">
    </div>

    <div class="comment-desc">
        <h6 class="mb-1">
            <strong>{{ $comment->customer->name ?? 'Anonymous' }}</strong>
        </h6>
        
        <p class="mt-2 mb-0">{{ $comment->comment }}</p>

        <!-- Reply Button -->
        <span class="text-muted small">
            <i class="fa fa-clock me-1"></i> {{ $comment->created_at->diffForHumans() }}
        </span>
        @if(Auth::guard('customer')->check())
            <button class="btn btn-sm btn-link text-primary reply-btn"
                    data-comment-id="{{ $comment->id }}"
                    data-username="{{ $comment->customer->name ?? 'Anonymous' }}">
                <i class="fa fa-reply"></i> Reply
            </button>
        @endif

        <!-- Recursively Load Replies -->
        @if($comment->replies->count() > 0)
            <div class="replies ms-5 mt-3">
                @foreach($comment->replies as $reply)
                    @include('web-page.blog.comment-item', ['comment' => $reply])
                @endforeach
            </div>
        @endif
    </div>
</div>
