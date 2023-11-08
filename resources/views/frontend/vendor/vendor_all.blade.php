@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Danh sách nhà cung cấp
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span>Danh sách nhà cung cấp
        </div>
    </div>
</div>


<div class="page-content pt-50">
    <div class="container">
        <div class="row mb-50">
            <div class="col-12 col-lg-8 mx-auto">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>Chúng tôi có <strong class="text-brand">{{ count($vendors) }}</strong> nhà cung cấp</p>
                    </div>

                </div>
            </div>
        </div>



        <div class="row vendor-grid">

            @foreach ($vendors as $vendor)
                <div class="col-lg-3 col-md-6 col-12 col-sm-6">
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
                                            href="{{ route('vendor.details', $vendor->id) }}">{{ $vendor->name }}</a>
                                    </h4>

                                    <div class="product-rate-cover">
                                        @php
                                            $arvarage = App\Models\Review::where('vendor_id', $vendor->id)
                                                ->where('status', 1)
                                                ->avg('rating');
                                            
                                            $reviewcount = App\Models\Review::where('vendor_id', $vendor->id)
                                                ->where('status', 1)
                                                ->latest()
                                                ->get();
                                        @endphp

                                        <div class="product-rate d-inline-block">
                                            @if ($arvarage == 0)
                                            @elseif($arvarage >= 1 && $arvarage < 2)
                                                <div class="product-rating" style="width: 20%"></div>
                                            @elseif($arvarage >= 2 && $arvarage < 3)
                                                <div class="product-rating" style="width: 40%"></div>
                                            @elseif($arvarage >= 3 && $arvarage < 4)
                                                <div class="product-rating" style="width: 60%"></div>
                                            @elseif($arvarage >= 4 && $arvarage < 5)
                                                <div class="product-rating" style="width: 80%"></div>
                                            @elseif($arvarage == 5)
                                                <div class="product-rating" style="width: 100%"></div>
                                            @endif
                                        </div>
                                        <span class="font-small ml-5 text-muted"> ({{ count($reviewcount) }} đánh
                                            giá)</span>
                                    </div>

                                </div>
                                <div class="mb-10">

                                    @php
                                        $products = App\Models\Product::where('vendor_id', $vendor->id)->get();
                                    @endphp
                                    <span class="font-small total-product">{{ count($products) }} sản phẩm</span>

                                </div>
                            </div>
                            <div class="vendor-info mb-30">
                                <ul class="contact-infor text-muted">
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                            alt="" /><strong>Địa chỉ: </strong>
                                        <span>{{ $vendor->address }}</span>
                                    </li>
                                    <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                            alt="" /><strong>Liên hệ: </strong><a
                                            href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></li>
                                </ul>
                            </div>
                            <a href="{{ route('vendor.details', $vendor->id) }}" class="btn btn-xs">Xem </a>
                        </div>
                    </div>
                </div>
                <!--end vendor card-->
            @endforeach


        </div>
    </div>
</div>
@endsection
