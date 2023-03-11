<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu">
            <ul>
                <li> 
                    <a href="{{route('dashboard')}}"><i class="la la-home"></i> <span>Quay lại trang chính</span></a>
                </li>

                <!-- <li class="{{ Request::routeIs('settings.company') ? 'active' : '' }}"> 
                    <a href="{{route('settings.company')}}"><i class="la la-building"></i> <span>Thông tin công ty</span></a>
                </li> -->

                <li class="{{ Request::routeIs('change-password') ? 'active' : '' }}"> 
                    <a href="{{route('change-password')}}"><i class="la la-lock"></i> <span>Đổi mật khẩu</span></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->