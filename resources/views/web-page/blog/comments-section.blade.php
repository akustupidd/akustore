<div class="comments-section mtb-40">
    <h3 class="sidebar-title">Comments</h3>

    <!-- Display Comments -->
    <div class="all-comments">
        @forelse($comments as $comment)
            @include('web-page.blog.comment-item', ['comment' => $comment])
        @empty
            <p class="text-muted">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>

    <!-- Comment Submission Form -->
    <div class="comment-form mt-4">
        <h5 class="mb-3">Leave a Comment</h5>
        @if(Auth::guard('customer')->check())
            <form action="{{ route('blog.comment', $blog->id) }}" method="POST">
                @csrf
                <input type="hidden" name="parent_id" id="parent_id" value="">
                <div class="mb-3">
                    <textarea name="comment" id="comment-textarea" class="form-control" rows="4" 
                              placeholder="Write your comment here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-comment"></i> Submit Comment
                </button>
            </form>
        @else
            <p class="text-danger">You must <a href="{{ route('customer.login') }}">log in</a> to post a comment.</p>
        @endif
    </div>
</div>
