<style>
/* Style for icons inside form fields */
.password-toggle-btn {
    position: absolute;
    top: 50%;
    right: 15px;
    transform: translateY(-50%);
    font-size: 18px;
    color: #7a7a7a;
    pointer-events: none;
}

.password-toggle-btn:hover {
    color: #144194; /* Optional: Change color on hover */
}

/* Customize icons */
.password-toggle .bx, .password-toggle .bxs-user, .password-toggle .bx-envelope, .password-toggle .bxs-phone, .password-toggle .bx-calendar {
    font-size: 20px; /* Adjust icon size */
    color: #7a7a7a; /* Set a default icon color */
}

/* Focus effect on icons */
.password-toggle input:focus + .password-toggle-btn .bx,
.password-toggle input:focus + .password-toggle-btn .bxs-user,
.password-toggle input:focus + .password-toggle-btn .bx-calendar,
.password-toggle input:focus + .password-toggle-btn .bx-envelope,
.password-toggle input:focus + .password-toggle-btn .bxs-phone {
    color: #144194; /* Change icon color when input is focused */
}

/* Optional: Style the password-toggle icon when input is active */
.password-toggle input:valid + .password-toggle-btn {
    color: #28a745; /* Change icon color when valid input is entered */
}

.password-toggle input:invalid + .password-toggle-btn {
    color: #dc3545; /* Change icon color for invalid input */
}

/* Style for the Date of Birth input with calendar icon */
.password-toggle .bx-calendar {
    font-size: 20px; /* Adjust calendar icon size */
    color: #7a7a7a;
}

/* Optional: Change calendar icon color when Date of Birth input is focused */
.password-toggle input[type="date"]:focus + .password-toggle-btn .bx-calendar {
    color: #144194; /* Change icon color on focus */
}


</style>
@extends('layout.web-app.app')
@section('title') Profile @endsection
@section('content-web')
<div class="container py-3">
    <div class="row mt-5 mb-5">
        @include('comons.menu-side-seeting')
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center pb-4 pb-lg-3 mb-lg-3">
              <h3 class="m-0 p-0" style="font-size: 25px ; color: #144194;">Personal Information</h3>
            </div>
            <form id="formAccountSettings" method="post" action="{{ route('profile.update')}}" enctype="multipart/form-data">
              @csrf
              @method('POST')
              <div class="bg-secondary rounded-lg p-4 mb-4">
                <div class="avatar-wrapper">
                  <div class="spinner">
                    <div class="spinner-dot"></div>
                    <div class="spinner-dot"></div>
                    <div class="spinner-dot"></div>
                  </div>
                  <div id="avatar"></div>
                  <div id="avatar-control-buttons" class="text-center d-none">
                    <button type="button" id="cancel-upload" class="btn btn-light btn-shadow btn-sm mb-2">
                      <i class="czi-close mr-2"></i>Cancel </button>
                    <button type="submit" id="save-photo" class="btn btn-light btn-shadow btn-sm mb-2">
                      <i class="czi-check mr-2"></i>Save </button>
                  </div>
                  @php
                    $user = Auth::guard('customer')->user();
                    $defaultImage = asset('assets/img/avatars/' .
                        ($user && $user->gender === 'female' ? 'female' : ($user && $user->gender === 'male' ? 'male' : 'other')) . '.jpg');
                    $imagePath = $user && isset($user->image) ? asset('uploads/users/' . $user->image) : $defaultImage;
                  @endphp
                  <div id="avatar-controls" class="media align-items-center px-4">
                    <img
                    class="rounded-circle"
                    src="{{ $imagePath }}"
                    width="90" alt="avatar"
                    style="height: 90px;object-fit: cover;"
                    >
                    <div class="media-body pl-3">
                      <button type="button" class="btn btn-light btn-shadow btn-sm mb-2" id="change-avatar" data-toggle="modal" data-target="#choose-modal">
                        <i class='bx bx-revision mr-1'></i>Change avatar </button>
                      <div class="p mb-0 font-size-ms text-muted">Upload JPG, PNG image required.</div>
                    </div>
                  </div>
                </div>
              </div>
              {{-- <div class="modal fade" id="choose-modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-4 avatar-source" id="no-photo" data-url="https://soklyphone.com/account/profile/avatar/update/external">
                          <img src="https://soklyphone.com/img/avatar.jpeg" class="rounded-circle img-thumbnail img-responsive">
                          <p class="mt-3 mt-3">Default</p>
                        </div>
                        <div class="col-md-4 avatar-source">
                          <div class="btn btn-light btn-upload bg-white">
                            <i class="fa fa-upload"></i>
                            <input type="file" name="image" id="avatar-upload" accept="image/png, image/jpeg">
                          </div>
                          <p class="mt-3">Upload Photo</p>
                        </div>
                        <div class="col-md-4 avatar-source source-external" data-url="{{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->image) ? asset('uploads/users/' . Auth::guard('customer')->user()->image) : '../assets/img/avatars/1.png'  }}">
                          <img
                          src="{{ $imagePath }}"
                          class="rounded-circle img-thumbnail img-responsive">
                          <p class="mt-3">Profile</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> --}}
              <div class="modal fade" id="choose-modal">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-body">
                      <div class="row">
                        <!-- Default Avatar -->
                        <div class="col-md-4 avatar-source" id="no-photo" data-url="https://soklyphone.com/account/profile/avatar/update/external">
                          <img src="https://soklyphone.com/img/avatar.jpeg" class="rounded-circle img-thumbnail img-responsive">
                          <p class="mt-3">Default</p>
                        </div>

                        <!-- Upload Avatar -->
                        <div class="col-md-4 avatar-source">
                          <div class="btn btn-light btn-upload bg-white">
                            <i class="fa fa-upload"></i>
                            <input type="file" name="image" id="avatar-upload" accept="image/png, image/jpeg">
                          </div>
                          <p class="mt-3">Upload Photo</p>
                        </div>

                        <!-- Profile Avatar -->
                        <div class="col-md-4 avatar-source source-external" data-url="{{ !is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->image) ? asset('uploads/users/' . Auth::guard('customer')->user()->image) : '../assets/img/avatars/1.png' }}">
                          <img src="{{ $imagePath }}" class="rounded-circle img-thumbnail img-responsive">
                          <p class="mt-3">Profile</p>
                        </div>
                      </div>

                      <!-- Cropper Preview -->
                      <div class="crop-container" style="display:none;">
                        <img id="image-preview" src="" style="max-width:100%; display:none;">
                      </div>

                      <!-- Buttons -->
                      <button id="crop-save" class="btn btn-primary" style="display:none;">Save Cropped Image</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- /.modal -->
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="password-toggle">
                      <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ Auth::guard('customer')->user()->name ?? '' }}"
                        placeholder="Enter your full name"
                        class="form-control"
                        required
                        aria-label="Full Name">
                      <label class="password-toggle-btn">
                        <i class='bx bxs-user password-toggle-indicator'></i>
                        <span class="sr-only">Show name</span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <div class="input-group date" data-provide="datepicker" data-date-format="dd-M-yyyy">
                      <input
                        type="date"
                        id="birthday"
                        name="dob"
                        value="{{ Auth::guard('customer')->user()->dob ?? '' }}"
                        placeholder="Enter your birthday"
                        class="form-control"
                        required
                        aria-label="Birthday"
                        onkeypress="disableInput(event);">
                      <div class="input-group-addon">
                        <label class="password-toggle-btn">
                          <span class="sr-only">Show birthday</span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <div class="password-toggle">
                      <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ Auth::guard('customer')->user()->email ?? '' }}"
                        placeholder="Enter your email"
                        class="form-control"
                        required
                        aria-label="Email">
                      <label class="password-toggle-btn">
                        <i class="bx bx-envelope password-toggle-indicator"></i>
                        <span class="sr-only">Show email</span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <div class="password-toggle">
                      <input
                        type="text"
                        id="phone"
                        name="phone_number"
                        value="{{ Auth::guard('customer')->user()->phone_number ?? '' }}"
                        placeholder="Enter your phone number"
                        class="form-control"
                        required
                        aria-label="Phone Number"
                        onkeypress="inputNumber(event);">
                      <label class="password-toggle-btn">
                        <i class="bx bxs-phone password-toggle-indicator"></i>
                        <span class="sr-only">Show phone</span>
                      </label>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12 mb-lg-4">
                  <label for="address">Address</label>
                  <textarea
                    id="address"
                    name="address"
                    class="form-control"
                    placeholder="Enter your address"
                    required
                    aria-label="Address">{{ Auth::guard('customer')->user()->address ?? '' }}</textarea>
                </div>

                <div class="col-12">
                  <hr class="mt-2 mb-3">
                  <div class="d-flex flex-wrap justify-content-center align-items-center mb-4 py-4">
                    <button type="submit" class="btn btn-primary btn-update mt-3 mt-sm-0 px-5">Update</button>
                  </div>
                </div>
              </div>
            </form>
        </div>
    </div>
</div>
<!-- Include Cropper.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">

<!-- Include Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

<script>
    // Initialize variables
let cropper;
const imageInput = document.getElementById('avatar-upload');
const previewImage = document.getElementById('image-preview');
const cropContainer = document.querySelector('.crop-container');
const saveButton = document.getElementById('crop-save');

// Listen for file input change
imageInput.addEventListener('change', function (event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            // Show the preview image and container
            previewImage.src = e.target.result;
            cropContainer.style.display = 'block';
            previewImage.style.display = 'block';
            
            // Initialize Cropper.js
            if (cropper) {
                cropper.destroy();
            }
            cropper = new Cropper(previewImage, {
                aspectRatio: 1, // Square crop
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
                scalable: true,
                zoomable: true,
                cropBoxResizable: true,
                ready: function () {
                    // You can call any custom logic after the cropper is initialized
                    console.log('Cropper ready!');
                }
            });

            // Show save button
            saveButton.style.display = 'inline-block';
        };
        reader.readAsDataURL(file);
    }
});

// Handle crop save button click
saveButton.addEventListener('click', function () {
    // Get the cropped image data URL
    const croppedCanvas = cropper.getCroppedCanvas({
        width: 1080, // Crop to 1080px wide
        height: 1080 // Crop to 1080px tall
    });

    // Get the cropped image data URL
    const croppedImageUrl = croppedCanvas.toDataURL();

    // Send the cropped image to the server (via AJAX)
    uploadCroppedImage(croppedImageUrl);
});

// Upload the cropped image
function uploadCroppedImage(imageDataUrl) {
    const formData = new FormData();
    formData.append('image', imageDataUrl);

    // Assuming you have a route for handling image upload
    fetch('/upload-avatar', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        console.log(data);
        // Optionally, update the UI or notify the user of success
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

</script>
@endsection
