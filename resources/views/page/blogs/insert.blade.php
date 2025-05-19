@extends('layout.app')
@section('title', 'Insert Blog')
@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blog /</span> Insert New Blog</h4>

    <div class="row">
        <!-- Left Side: Blog Preview -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Live Blog Preview</h5>
                </div>
                <div class="card-body">
                    <div id="livePreview" class="border p-3 rounded bg-light">
                        <h3 id="previewTitle" class="text-primary">Blog Title</h3>
                        <small class="text-muted">Preview Mode</small>
                        <p id="previewContent" class="mt-2">Blog content will appear here...</p>
                        
                        <div id="previewMedia" class="mt-3">
                            <img id="previewImage" src="" alt="Preview Image" class="rounded d-none" 
                                 style="width: 100%; max-width: 500px; object-fit: cover;">
                            <video id="previewVideo" class="d-none mt-2" controls style="width: 100%; max-width: 500px;">
                                <source src="" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Blog Form -->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Create New Blog</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('data-insert-blog') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Title -->
                        <div class="mb-3">
                            <label class="form-label" for="title">Title</label>
                            <input type="text" id="title" name="title" class="form-control" placeholder="Enter Blog Title" value="{{ old('title') }}" required>
                        </div>

                        <!-- Content with CKEditor -->
                        <div class="mb-3">
                            <label class="form-label" for="content">Content</label>
                            <textarea id="content" name="content" class="form-control" rows="5">{{ old('content') }}</textarea>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label class="form-label" for="image">Cover Image</label>
                            <input type="file" id="image" name="image" class="form-control" accept="image/*">
                        </div>

                        <!-- Video Upload -->
                        <div class="mb-3">
                            <label class="form-label" for="video">Upload Video</label>
                            <input type="file" id="video" name="video" class="form-control" accept="video/*">
                        </div>

                        <!-- Category Selection -->
                        <div class="mb-3">
                            <label class="form-label" for="blog_category_id">Category</label>
                            <select name="blog_category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags Input -->
                        <div class="mb-3">
                            <label class="form-label" for="tags">Tags (comma separated)</label>
                            <input type="text" id="tags" name="tags" class="form-control" placeholder="Enter Tags" value="{{ old('tags') }}">
                        </div>

                        <!-- Status Selection -->
                        <div class="mb-3">
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="draft">Draft</option>
                                <option value="published">Published</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>

                        <!-- Published At Date -->
                        <div class="mb-3">
                            <label class="form-label" for="published_at">Publish Date</label>
                            <input type="date" name="published_at" class="form-control" value="{{ old('published_at') }}">
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary">Publish</button>
                            <button type="button" class="btn btn-warning" id="draft-btn">Save as Draft</button>
                            <button class="btn btn-danger" onclick="history.back(); return false;">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Load CKEditor & JavaScript -->
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        CKEDITOR.replace("content", {
            extraPlugins: "uploadimage,colorbutton,font,justify",
            removePlugins: "image2",
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: "form",
        });

        // ✅ Fix for CKEditor Real-time Preview
        CKEDITOR.instances.content.on("change", function () {
            document.getElementById("previewContent").innerHTML = CKEDITOR.instances.content.getData();
        });

        // ✅ Live preview for title
        document.getElementById("title").addEventListener("input", function () {
            document.getElementById("previewTitle").innerText = this.value || "Blog Title";
        });

        // ✅ Live preview for image
        document.getElementById("image").addEventListener("change", function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("previewImage").src = e.target.result;
                    document.getElementById("previewImage").classList.remove("d-none");
                    document.getElementById("previewVideo").classList.add("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // ✅ Live preview for video
        document.getElementById("video").addEventListener("change", function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById("previewVideo").src = e.target.result;
                    document.getElementById("previewVideo").classList.remove("d-none");
                    document.getElementById("previewImage").classList.add("d-none");
                };
                reader.readAsDataURL(file);
            }
        });

        // ✅ Save as Draft Function
        document.getElementById("draft-btn").addEventListener("click", function () {
            document.getElementById("status").value = "draft";
            document.querySelector("form").submit();
        });
    });
</script>

@endsection
