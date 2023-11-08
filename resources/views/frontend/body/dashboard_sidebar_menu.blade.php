@php
    // get current name route
    $route = Route::current()->getName();
@endphp


<div class="col-md-3">
    <div class="dashboard-menu">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ $route == 'dashboard' ? 'active' : '' }}" href="{{ route('dashboard') }}"><i
                        class="fi-rs-settings-sliders mr-10"></i>Tài khoản</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.orders.page' ? 'active' : '' }}"
                    href="{{ route('user.orders.page') }}"><i class="fi-rs-shopping-bag mr-10"></i>Đơn hàng</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.return.orders.page' ? 'active' : '' }}"
                    href="{{ route('user.return.orders.page') }}"><i class="fa-solid fa-right-left mr-10"></i>Đơn hàng
                    hoàn lại</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.track.order.page' ? 'active' : '' }}"
                    href="{{ route('user.track.order.page') }}"><i class="fi-rs-shopping-cart-check mr-10"></i>Theo dõi
                    đơn hàng</a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.account.page' ? 'active' : '' }}"
                    href="{{ route('user.account.page') }}"><i class="fi-rs-user mr-10"></i>Thông tin tài khoản</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $route == 'user.change.password' ? 'active' : '' }}"
                    href="{{ route('user.change.password') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Đổi mật
                    khẩu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.logout') }}"><i class="fi-rs-sign-out mr-10"></i>Đăng
                    xuất</a>
            </li>
        </ul>
    </div>
</div>
