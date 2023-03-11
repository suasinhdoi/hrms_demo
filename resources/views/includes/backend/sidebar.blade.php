<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ route_is('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#" class="{{ route_is(['employees','employees-list']) ? 'active' : '' }} "><i class="la la-user"></i> <span> Nhân Sự</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ route_is(['employees','employees-list']) ? 'active' : '' }}" href="{{route('employees-list')}}">Danh sách</a></li>
                        <li><a class="{{ route_is('holidays') ? 'active' : '' }}" href="{{route('holidays')}}">Ngày nghỉ</a></li>
                        <li><a class="{{ route_is('employees.attendance') ? 'active' : '' }}" href="{{route('employees.attendance')}}">Chấm công</a></li>
                        <li><a class="{{ route_is('leave-type') ? 'active' : '' }}" href="{{route('leave-type')}}">Loại nghỉ phép</a></li>
                        <li><a class="{{ route_is('employee-leave') ? 'active' : '' }}" href="{{route('employee-leave')}}">Nghỉ phép</a></li>
                        <li><a class="{{ route_is('departments') ? 'active' : '' }}" href="{{route('departments')}}">Phòng ban</a></li>
                        <li><a class="{{ route_is('designations') ? 'active' : '' }}" href="{{route('designations')}}">Chức Danh</a></li>
                        <li><a class="{{ route_is('overtime') ? 'active' : '' }}" href="{{route('overtime')}}">Tăng ca</a></li>
                    </ul>
                </li>
                
                <li class="{{ route_is('users') ? 'active' : '' }}">
                    <a href="{{route('users')}}"><i class="la la-user-plus"></i> <span>Tài khoản</span></a>
                </li>
              
                <li class="{{ route_is('change-password') ? 'active' : '' }}">
                    <a href="{{route('change-password')}}"><i class="la la-lock"></i> <span>Đổi mật khẩu</span></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
