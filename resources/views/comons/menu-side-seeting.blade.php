<style>
   @media (max-width: 991.98px) { /* Corresponds to Bootstrap's lg breakpoint */
    .col-lg-3 {
        display: none;
    }
}
</style>
<div class="col-lg-3 pt-4 pt-lg-0">
    <div class="rounded-lg box-shadow-lg px-0 pb-0 mb-5 mb-lg-0 border">
        <div class="px-4 bg-fill rounded-top border-bottom">
            <div class="media align-items-center py-3">
                <!-- Profile Image -->
                {{-- <div class="img-thumbnail rounded-circle position-relative" style="width: 6.375rem;">
                    <img 
                        class="rounded-circle img-fluid" 
                        src="{{ !is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->image) ? asset('uploads/users/' . Auth::guard('customer')->user()->image) : asset('assets/img/avatars/1.png') }}"  
                        alt="avatar"
                        style="height: 90px 90px;object-fit: cover;"
                        onerror="this.src='{{ asset('assets/img/avatars/1.png') }}';"
                    >
                </div> --}}
                <!-- Profile Name and Email -->
                <div class="media-body pl-3">
                    <h3 class="font-size-base mb-0">
                        {{ !is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->name) ? Auth::guard('customer')->user()->name : 'Guest' }}
                    </h3>
                    <span class="text-accent font-size-sm">
                        {{ !is_null(Auth::guard('customer')->user()) && isset(Auth::guard('customer')->user()->email) ? Auth::guard('customer')->user()->email : 'Not Available' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Sidebar Navigation -->
        <div>
            <ul class="list-unstyled">
                <!-- My Order -->
                <li class="border-bottom justify-content-center px-4 py-3 hover-menu {{ Route::currentRouteName() == 'my-order' ? 'active-menu' : '' }}">
                    <a href="{{ route('my-order') }}">
                        <div class="sidebar-item">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                <path d="M11,0A11,11,0,1,0,22,11,11,11,0,0,0,11,0ZM8,15.231h6.833a1.612,1.612,0,1,1-1.541,1.141H8.658A1.611,1.611,0,1,1,6.84,15.257L6.557,13.7l0-.015-1.5-7.434-1.38.009L3.664,5.116,5.985,5.1l.561,2.778,10.4,1.247-1.321,5.035H7.8Z"></path>
                            </svg> 
                            My Order
                        </div>
                    </a>
                </li>
                <!-- My Coupon -->
                <li class="border-bottom justify-content-center px-4 py-3 hover-menu {{ Route::currentRouteName() == 'coupon' ? 'active-menu' : '' }}">
                    <a href="{{ route('coupon') }}">
                        <div class="sidebar-item">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                <path d="M11,22A11,11,0,0,1,3.222,3.222,11,11,0,1,1,18.778,18.778,10.928,10.928,0,0,1,11,22ZM6.483,15.457a.174.174,0,0,1,.16.16v.4h10.64a.8.8,0,0,0,.8-.8V6.784a.8.8,0,0,0-.8-.8H6.643v.4a.161.161,0,1,1-.321,0v-.4H4.716a.8.8,0,0,0-.8.8V9.354a.4.4,0,0,0,.4.4,1.225,1.225,0,0,1,0,2.449.4.4,0,0,0-.4.4v2.61a.8.8,0,0,0,.8.8H6.322v-.4A.174.174,0,0,1,6.483,15.457Zm0-.482a.174.174,0,0,1-.161-.16v-.843a.161.161,0,0,1,.321,0v.843A.174.174,0,0,1,6.483,14.974Z"></path>
                            </svg>
                            My Coupon
                        </div>
                    </a>
                </li>
                <!-- Favorite -->
                <li class="border-bottom justify-content-center px-4 py-3 hover-menu {{ Route::currentRouteName() == 'favorite' ? 'active-menu' : '' }}">
                    <a href="{{ route('favorite') }}">
                        <div class="sidebar-item">
                            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                                <path d="M11,22A11,11,0,0,1,3.222,3.222,11,11,0,1,1,18.778,18.778,10.928,10.928,0,0,1,11,22ZM7.933,5.816A3.741,3.741,0,0,0,5.152,7.026a4.345,4.345,0,0,0-1.1,2.967A5.174,5.174,0,0,0,5.428,13.38a29.3,29.3,0,0,0,3.447,3.236l0,0,.123.1c.444.379.946.807,1.46,1.257a.817.817,0,0,0,1.075,0c.58-.507,1.137-.981,1.584-1.362l0,0a29.3,29.3,0,0,0,3.447-3.236,5.173,5.173,0,0,0,1.378-3.387,4.345,4.345,0,0,0-1.1-2.967,3.741,3.741,0,0,0-2.781-1.211,3.5,3.5,0,0,0-2.184.754A4.494,4.494,0,0,0,11,7.492a4.446,4.446,0,0,0-.883-.922A3.5,3.5,0,0,0,7.933,5.816Z"></path>
                            </svg>
                            Favorite
                        </div>
                    </a>
                </li>
                <!-- Information -->
                <li class="border-bottom justify-content-center px-4 py-3 hover-menu {{ Route::currentRouteName() == 'profile' ? 'active-menu' : '' }}">
                  <a href="{{route('profile')}}">
                      <div class="sidebar-item">
                      <!-- <i class="icons.personal-information mr-2"></i>    -->
                      <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                          <path id="Subtraction_17" data-name="Subtraction 17" d="M11,22A11,11,0,0,1,3.222,3.222,11,11,0,1,1,18.778,18.778,10.928,10.928,0,0,1,11,22ZM8.881,12.2A2.987,2.987,0,0,0,6.2,13.856L5.064,16.13A.6.6,0,0,0,5.6,17H16.4a.6.6,0,0,0,.509-.286.592.592,0,0,0,.024-.584L15.8,13.856A2.984,2.984,0,0,0,13.119,12.2ZM11,5a3,3,0,1,0,3,3A3,3,0,0,0,11,5Z"></path>
                      </svg> Personal Information
                      </div>
                  </a>
                </li>
                <!-- Password Change -->
                <li class="border-bottom justify-content-center px-4 py-3 hover-menu {{ Route::currentRouteName() == 'change-password' ? 'active-menu' : '' }}">
                    <a href="{{route('change-password')}}">
                    <div class="sidebar-item">
                        <!-- <i class="icons.change-password mr-2"></i>    -->
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                        <path id="Subtraction_8" data-name="Subtraction 8" d="M11,22A11,11,0,0,1,3.222,3.222,11,11,0,1,1,18.778,18.778,10.928,10.928,0,0,1,11,22ZM6.168,9.294a.285.285,0,0,0-.284.284v7.106a1.139,1.139,0,0,0,1.138,1.138H14.98a1.139,1.139,0,0,0,1.138-1.138V9.579a.285.285,0,0,0-.284-.284H14.98V8.158a3.979,3.979,0,1,0-7.959,0V9.294Zm5.4,6.254H10.432a.283.283,0,0,1-.283-.316l.179-1.613a1.118,1.118,0,0,1-.465-.914,1.137,1.137,0,0,1,2.274,0,1.119,1.119,0,0,1-.465.914l.179,1.613a.285.285,0,0,1-.071.221A.281.281,0,0,1,11.569,15.548Zm1.705-6.254H8.726V8.158a2.274,2.274,0,1,1,4.548,0V9.293Z"></path>
                        </svg> Change Password
                    </div>
                    </a>
                </li>
                <!-- Information -->
                <li class=" justify-content-center px-4 py-3 hover-menu">
                    <a href="{{ route('customer.logout')}}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="sidebar-item">
                        <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22">
                            <path id="Subtraction_21" data-name="Subtraction 21" d="M11,22A11,11,0,0,1,3.222,3.222,11,11,0,1,1,18.778,18.778,10.928,10.928,0,0,1,11,22ZM6.084,5A1.085,1.085,0,0,0,5,6.084v9.749a1.093,1.093,0,0,0,.738,1.03L9,17.949a1.121,1.121,0,0,0,.336.05,1.085,1.085,0,0,0,1.084-1.084v-.542h1.625a1.626,1.626,0,0,0,1.625-1.625V12.583a.541.541,0,1,0-1.083,0v2.166a.542.542,0,0,1-.542.542H10.417V7.167a1.094,1.094,0,0,0-.738-1.03l-.16-.053h2.523a.542.542,0,0,1,.542.541V8.25a.541.541,0,0,0,1.083,0V6.625A1.626,1.626,0,0,0,12.041,5H6.219a.123.123,0,0,0-.034.006l-.024.005a.253.253,0,0,1-.035-.006A.207.207,0,0,0,6.084,5Zm6.5,4.874a.542.542,0,1,0,0,1.084h2.166v1.625a.54.54,0,0,0,.334.5.545.545,0,0,0,.59-.118L17.84,10.8a.54.54,0,0,0,0-.766L15.674,7.867a.542.542,0,0,0-.924.383V9.875Z"></path>
                        </svg> Logout
                    </div>
                    </a>
                    <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none"> @csrf @method('POST') </form>
                </li>
            </ul>
        </div>
    </div>
</div>