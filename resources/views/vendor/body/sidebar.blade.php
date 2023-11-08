@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::findOrFail($id);
    $status = $vendorId->status;
@endphp

<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Nhà cung cấp</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-menu'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('vendor.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Trang chủ</div>
            </a>
        </li>

        @if ($status === 'active')
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="bx bx-cart"></i>
                    </div>
                    <div class="menu-title">Sản phẩm</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.product') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách
                            sản phẩm</a>
                    </li>
                    <li> <a href="{{ route('vendor.add.product') }}"><i class="bx bx-right-arrow-alt"></i>Thêm sản
                            phẩm</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <div class="menu-title">Đơn hàng</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.order') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách đơn
                            hàng</a>
                    </li>

                    <li> <a href="{{ route('vendor.return.orders') }}"><i class="bx bx-right-arrow-alt"></i>Đơn hàng
                            đang hoàn lại</a>
                    </li>

                    <li> <a href="{{ route('vendor.complete.return.orders') }}"><i class="bx bx-right-arrow-alt"></i>Đơn
                            hàng đã hoàn lại </a>
                    </li>
                </ul>
            </li>


            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <div class="menu-title">Đánh giá</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.all.review') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách
                            đánh giá</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon">
                        <i class="fa-solid fa-cubes"></i>
                    </div>
                    <div class="menu-title">Tồn kho & Hết hàng</div>
                </a>
                <ul>
                    <li> <a href="{{ route('vendor.stock.product', Auth::user()->id) }}"><i
                                class="bx bx-right-arrow-alt"></i>Sản phẩm tồn kho</a>
                    </li>
                    <li> <a href="{{ route('vendor.out_stock.product', Auth::user()->id) }}"><i
                                class="bx bx-right-arrow-alt"></i>Sản phẩm đã bán hết</a>
                    </li>
                </ul>
            </li>
        @else
        @endif
    </ul>
    <!--end navigation-->
</div>
