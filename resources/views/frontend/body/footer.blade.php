@php
    $setting = App\Models\SiteSetting::find(1);
@endphp


<footer class="main">
    <section class="featured section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 mb-md-4 mb-xl-0">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Giá & Ưu đãi tốt nhất</h3>
                            <p>Đơn hàng 1.000.000₫ trở lên</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".1s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Miễn phí giao hàng tận nơi</h3>
                            <p>Trung tâm dịch vụ hỗ trợ 24/7</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".2s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Đặt hàng nhanh chóng</h3>
                            <p>Đăng nhập để nhận ưu đãi</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".3s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Sản phẩm đa dạng mẫu mã</h3>
                            <p>Nhận phiếu giảm giá lên tới 50%</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".4s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-5.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Dễ dàng đổi trả sản phẩm</h3>
                            <p>Khách hàng đổi trả chỉ trong vòng 7 ngày</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-1-5 col-md-4 col-12 col-sm-6 d-xl-none">
                    <div class="banner-left-icon d-flex align-items-center wow animate__animated animate__fadeInUp"
                        data-wow-delay=".5s">
                        <div class="banner-icon">
                            <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-6.svg') }}" alt="" />
                        </div>
                        <div class="banner-text">
                            <h3 class="icon-box-title">Safe delivery</h3>
                            <p>Within 30 days</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp"
                        data-wow-delay="0">
                        <div class="logo mb-30">
                            <a href="index.html" class="mb-15"><img src="{{ asset($setting->logo) }}"
                                    alt="logo" /></a>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Địa chỉ: </strong>
                                <span>{{ $setting->company_address }}</span>
                            </li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Liên hệ: </strong><a
                                    href="tel:{{ $setting->phone_one }}">{{ $setting->phone_one }}</a></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}"
                                    alt="" /><strong>Email: </strong><a
                                    href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Ezone Việt Nam</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Thông tin công ty</a></li>
                        <li><a href="#">Chính sách giao hàng</a></li>
                        <li><a href="#">Chính sách bảo mật</a></li>
                        <li><a href="#">Điều kiện &amp; Điều khoản</a></li>
                        <li><a href="#">Liên hệ chúng tôi</a></li>
                        <li><a href="#">Trung tâm hỗ trợ</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Tài khoản</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @guest
                            <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                            <li><a href="{{ route('become.vendor') }}">Trở thành nhà cung cấp</a></li>
                            <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                            <li><a href="{{ route('wishlist') }}">Sản phẩm yêu thích</a></li>
                            <li><a href="{{ route('user.track.order.page') }}">Theo dõi đơn hàng</a></li>
                            <li><a href="{{ route('compare') }}">So sánh sản phẩm</a></li>
                        @else
                            <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                            <li><a href="{{ route('wishlist') }}">Sản phẩm yêu thích</a></li>
                            <li><a href="{{ route('user.track.order.page') }}">Theo dõi đơn hàng</a></li>
                            <li><a href="{{ route('compare') }}">So sánh sản phẩm</a></li>
                        @endguest
                    </ul>
                </div>

                @php
                    $categories = App\Models\Category::orderBy('created_at', 'DESC')
                        ->limit(6)
                        ->get();
                @endphp

                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <h4 class="widget-title">Danh mục</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        @foreach ($categories as $category)
                            <li><a
                                    href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}">{{ $category->category_name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; {{ $setting->copyright }}</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>{{ $setting->support_phone }}<span>Trung tâm hỗ trợ 24/7</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Theo dõi chúng tôi trên</h6>
                    <a href="{{ $setting->facebook }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->instagram }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}"
                            alt="" /></a>
                    <a href="{{ $setting->youtube }}"><img
                            src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}"
                            alt="" /></a>
                </div>
            </div>
        </div>
    </div>
</footer>
