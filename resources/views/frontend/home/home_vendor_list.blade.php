@php
    // Get vendor with create_at is oldest
    $vendors = App\Models\User::where('status', 'active')
        ->where('role', 'vendor')
        ->orderBy('name', 'ASC')
        ->limit(4)
        ->get();
@endphp

<div class="container">

    <div class="section-title wow animate__animated animate__fadeIn" data-wow-delay="0">
        <h3 class="">Danh sách nhà cung cấp của chúng tôi</h3>
        <a class="show-all" href="{{ route('vendor.all') }}">
            Tất cả
            <i class="fi-rs-angle-right"></i>
        </a>
    </div>


    <div class="row vendor-grid">

        @foreach ($vendors as $vendor)
            <div class="col-lg-3 col-md-6 col-12 col-sm-6 justify-content-center">
                <div class="vendor-wrap mb-40">
                    <div class="vendor-img-action-wrap">
                        <div class="vendor-img">
                            <a href="{{ route('vendor.details', $vendor->id) }}">
                                <img class="default-img"
                                    src="{{ !empty($vendor->photo) ? url($vendor->photo) : url('upload/no_image.jpg') }}"
                                    alt="" />
                            </a>
                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="hot">Shop Mall</span>
                        </div>
                    </div>
                    <div class="vendor-content-wrap">
                        <div class="d-flex justify-content-between align-items-end mb-30">
                            <div>
                                <div class="product-category">
                                    <span class="text-muted">Từ năm {{ $vendor->vendor_join }}</span>
                                </div>
                                <h4 class="mb-5"><a
                                        href="{{ route('vendor.details', $vendor->id) }}">{{ $vendor->name }}</a></h4>
                                <div class="product-rate-cover">
                                    @php
                                        $products = App\Models\Product::where('vendor_id', $vendor->id)->get();
                                    @endphp
                                    <span class="font-small total-product">{{ count($products) }} sản phẩm</span>
                                </div>
                            </div>

                        </div>
                        <div class="vendor-info mb-30">
                            <ul class="contact-infor text-muted">

                                <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                        alt="" /><strong>Liên hệ: </strong><a
                                        href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></li>
                            </ul>
                        </div>
                        <a href="{{ route('vendor.details', $vendor->id) }}" class="btn btn-xs">Xem <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <!--end vendor card-->
        @endforeach

    </div>
</div>
