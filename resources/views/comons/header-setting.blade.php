<div class="media align-items-center py-3">
    @php
        $user = Auth::guard('customer')->user();
        $defaultImage = asset('assets/img/avatars/' .
            ($user && $user->gender === 'female' ? 'female' : ($user && $user->gender === 'male' ? 'male' : 'other')) . '.jpg');
        $imagePath = $user && isset($user->image) ? asset('uploads/users/' . $user->image) : $defaultImage;
    @endphp
    <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
    <img class="rounded-circle"
    src="{{ $imagePath }}"
    alt="avatar"
    >
    </div>
    <div class="media-body pl-3">
    <h3 class="font-size-base mb-0">{{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->name) ? Auth::guard('customer')->user()->name : 'Admin'  }}</h3>
    <span class="text-accent font-size-sm">{{!is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->email) ? Auth::guard('customer')->user()->email : 'admin@gmail.com'  }}</span>
    </div>
</div>
