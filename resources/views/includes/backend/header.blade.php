<!-- Header -->
<div class="header">
			
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>
    
    <!-- Header Title -->
    <div class="page-title-box">
        <h3>{{ucwords(app(App\Settings\CompanySettings::class)->company_name ?? 'Smart HR')}}</h3>
    </div>
    <!-- /Header Title -->
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">
    
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar) : asset('assets/img/user.jpg')}}" alt="user">
                <span class="status online"></span></span>
                <span>{{auth()->user()->name}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}">Cá nhân</a>
                <!-- <a class="dropdown-item" href="{{route('settings.theme')}}">Cài đặt</a> -->
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Đăng xuất</button>
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">Cá nhân</a>
            <!-- <a class="dropdown-item" href="{{route('settings.theme')}}">Cài đặt</a> -->
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Đăng xuất</button>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>
<!-- /Header -->