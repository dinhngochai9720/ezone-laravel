<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-menu'></i>
        </div>
    </div>

    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Trang chủ</div>
            </a>
        </li>

        <li class="menu-label">Quản lý Website</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Thương hiệu</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.brand') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách thương
                        hiệu</a>
                </li>
                <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Thêm thương hiệu</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Danh mục</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.category') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách danh
                        mục</a>
                </li>
                <li> <a href="{{ route('add.category') }}"><i class="bx bx-right-arrow-alt"></i>Thêm danh mục</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-bookmark-heart"></i>
                </div>
                <div class="menu-title">Danh mục con</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách danh
                        mục con</a>
                </li>
                <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Thêm danh mục
                        con</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cart"></i>
                </div>
                <div class="menu-title">Sản phẩm</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.product') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách sản
                        phẩm</a>
                </li>
                <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Thêm sản phẩm</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Slider</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.slider') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách Slider</a>
                </li>
                <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Thêm Slider</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-message-square-edit"></i>
                </div>
                <div class="menu-title">Banner</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.banner') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách Banner</a>
                </li>
                <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Thêm Banner</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-diamond"></i>
                </div>
                <div class="menu-title">Coupon</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách Coupon</a>
                </li>
                <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Thêm Coupon</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-blog"></i>
                </div>
                <div class="menu-title">Bài viết & Tin tức</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.blog.category') }}"><i class="bx bx-right-arrow-alt"></i>Danh
                        sách danh mục </a>
                </li>

                <li> <a href="{{ route('admin.all.blog.post') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách
                        bài viết & tin tức </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Quản lý đơn hàng</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <div class="menu-title">Khu vực giao hàng</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.division') }}"><i class="bx bx-right-arrow-alt"></i>Thành
                        phố/tỉnh</a>
                </li>
                <li> <a href="{{ route('all.district') }}"><i class="bx bx-right-arrow-alt"></i>Quận/huyện</a>
                </li>
                <li> <a href="{{ route('all.state') }}"><i class="bx bx-right-arrow-alt"></i>Đường/phường/xã</a>
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
                <li> <a href="{{ route('admin.pending.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn hàng
                        chờ xử lý</a>
                </li>

                <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn
                        hàng đã xác nhận</a>
                </li>

                <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn
                        hàng đang xử lý </a>
                </li>

                <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Đơn
                        hàng đã giao </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-right-left"></i>
                </div>
                <div class="menu-title">Đơn hàng hoàn lại</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.return.request.orders') }}"><i class="bx bx-right-arrow-alt"></i>Đơn
                        hàng đang hoàn lại </a>
                </li>

                <li> <a href="{{ route('admin.complete.return.request.order') }}"><i
                            class="bx bx-right-arrow-alt"></i>Đơn hàng đã hoàn lại</a>
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
                <li> <a href="{{ route('admin.pending.review') }}"><i class="bx bx-right-arrow-alt"></i>Đánh
                        giá chờ xử lý </a>
                </li>

                <li> <a href="{{ route('admin.publish.review') }}"><i class="bx bx-right-arrow-alt"></i>Đánh
                        giá đã duyệt</a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-flag"></i>
                </div>
                <div class="menu-title">Báo cáo</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.report.view') }}"><i class="bx bx-right-arrow-alt"></i>Báo cáo
                        đơn hàng theo ngày/tháng/năm </a>
                </li>

                <li> <a href="{{ route('admin.order-by-user') }}"><i class="bx bx-right-arrow-alt"></i>Báo cáo
                        đơn hàng theo khách hàng</a>
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
                <li> <a href="{{ route('admin.stock.product') }}"><i class="bx bx-right-arrow-alt"></i> Sản
                        phẩm tồn kho </a>
                </li>
                <li> <a href="{{ route('admin.out_stock.product') }}"><i class="bx bx-right-arrow-alt"></i> Sản
                        phẩm đã bán hết </a>
                </li>
            </ul>
        </li>

        <li class="menu-label">Quản lý tài khoản</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div class="menu-title">Tài khoản</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.all.user') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách tài
                        khoản người dùng </a>
                </li>

                <li> <a href="{{ route('admin.all.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách
                        tài khoản nhà cung cấp </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-house-user"></i>
                </div>
                <div class="menu-title">Nhà cung cấp </div>
            </a>
            <ul>
                <li> <a href="{{ route('active.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách nhà
                        cung cấp được phép hoạt động</a>
                </li>
                <li> <a href="{{ route('inactive.vendor') }}"><i class="bx bx-right-arrow-alt"></i>Danh sách
                        nhà cung cấp không được phép hoạt động</a>
                </li>

            </ul>
        </li>

        <li class="menu-label">Quản lý Setting</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon">
                    <i class="fa-solid fa-gears"></i>
                </div>
                <div class="menu-title">Site & SEO</div>
            </a>
            <ul>
                <li> <a href="{{ route('admin.site.setting') }}"><i class="bx bx-right-arrow-alt"></i> Site
                        Setting </a>
                </li>

                <li> <a href="{{ route('admin.seo.setting') }}"><i class="bx bx-right-arrow-alt"></i> SEO Setting
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
