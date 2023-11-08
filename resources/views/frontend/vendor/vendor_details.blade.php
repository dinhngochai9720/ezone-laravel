@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $vendor->name }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> {{ $vendor->name }}
        </div>
    </div>
</div>


<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>Tìm thấy <strong class="text-brand">{{ count($products_vendor) }}</strong> sản phẩm</p>
                </div>
            </div>
            <div class="row product-grid">
                @forelse ($products_vendor as  $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                        <img class="default-img" src="{{ asset($product->product_thumbnail) }}"
                                            alt="" />
                                    </a>
                                </div>

                                <div class="product-action-1">
                                    <a aria-label="Yêu thích" class="action-btn" id="{{ $product->id }}"
                                        onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="So sánh" class="action-btn"id="{{ $product->id }}"
                                        onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                        onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                </div>

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    
                                    if ($amount < 0) {
                                        $discount = ($product->discount_price / $product->selling_price) * 100;
                                    } else {
                                        $discount = ($amount / $product->selling_price) * 100;
                                    }
                                @endphp

                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if ($product->discount_price == $product->selling_price && $product->product_qty > 0)
                                        <span class="sale">Mới</span>
                                    @elseif ($product->discount_price > $product->selling_price && $product->product_qty > 0)
                                        <span class="best">
                                            <i class="fa-solid fa-arrow-up"></i>
                                            {{ round($discount) }}%</span>
                                    @elseif ($product->discount_price < $product->selling_price && $product->product_qty > 0)
                                        <span class="new">
                                            <i class="fa-solid fa-arrow-down"></i>
                                            {{ round($discount) }}%
                                        </span>
                                    @else
                                        <span class="hot">
                                            Hết hàng
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a
                                        href="{{ url('product/category/' . $product->category_id . '/' . $product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                                </div>

                                <h2><a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h2>

                                @php
                                    $arvarage = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->avg('rating');
                                    
                                    $reviewcount = App\Models\Review::where('product_id', $product->id)
                                        ->where('status', 1)
                                        ->latest()
                                        ->get();
                                @endphp

                                <div class="product-rate-cover">
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

                                    <span class="font-small ml-5 text-muted"> ({{ count($reviewcount) }})</span>
                                </div>

                                <div>
                                    <span class="font-small text-muted">Nhà cung cấp <a
                                            href="{{ route('vendor.details', $vendor->id) }}">{{ $product['vendor']['name'] }}</a></span>
                                    {{-- vendor is relationship in Product Model --}}

                                </div>

                                <div class="product-card-bottom">
                                    @if ($product->discount_price == $product->selling_price)
                                        <div class="product-price">
                                            <span>{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                        </div>
                                    @else
                                        <div class="product-price">
                                            <span>{{ number_format($product->discount_price, 0, '.', '.') }}₫</span>
                                            <span
                                                class="old-price">{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="product-card-bottom">
                                    <div class="add-cart">
                                        <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                            class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-secondary text-center">Không tìm thấy sản phẩm</h3>
                @endforelse
            </div>
        </div>

        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                <div class="vendor-logo mb-30">
                    <img src="{{ !empty($vendor->photo) ? url($vendor->photo) : url('upload/no_image.jpg') }}"
                        alt="" />
                </div>
                <div class="vendor-info">
                    <div class="product-category">
                        <span class="text-muted">Từ năm {{ $vendor->vendor_join }}</span>
                    </div>
                    <h4 class="mb-5"><a href="{{ route('vendor.details', $vendor->id) }}"
                            class="text-heading">{{ $vendor->name }}</a></h4>

                    <div class="product-rate-cover mb-15">
                        @php
                            $arvarage_vendor = App\Models\Review::where('vendor_id', $vendor->id)
                                ->where('status', 1)
                                ->avg('rating');
                            
                            $reviewcount_vendor = App\Models\Review::where('vendor_id', $vendor->id)
                                ->where('status', 1)
                                ->get();
                        @endphp

                        <div class="product-rate d-inline-block">
                            @if ($vendor->id == null)
                            @else
                                @if ($arvarage_vendor == 0)
                                @elseif($arvarage_vendor >= 1 && $arvarage_vendor < 2)
                                    <div class="product-rating" style="width: 20%"></div>
                                @elseif($arvarage_vendor >= 2 && $arvarage_vendor < 3)
                                    <div class="product-rating" style="width: 40%"></div>
                                @elseif($arvarage_vendor >= 3 && $arvarage_vendor < 4)
                                    <div class="product-rating" style="width: 60%"></div>
                                @elseif($arvarage_vendor >= 4 && $arvarage_vendor < 5)
                                    <div class="product-rating" style="width: 80%"></div>
                                @elseif($arvarage_vendor == 5)
                                    <div class="product-rating" style="width: 100%"></div>
                                @endif
                            @endif
                        </div>

                        <span class="font-small ml-5 text-muted"> ({{ count($reviewcount_vendor) }} đánh giá)</span>
                    </div>



                    <div class="vendor-des mb-30">
                        <p class="font-sm text-heading">{{ $vendor->vendor_short_info }}</p>
                    </div>

                    <div class="follow-social mb-20">
                        <h6 class="mb-15">Theo dõi chúng tôi trên</h6>
                        <ul class="social-network">
                            <li class="hover-up">
                                <a href="{{ $vendor->youtube }}">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-tw.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="{{ $vendor->facebook }}">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-fb.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                            <li class="hover-up">
                                <a href="{{ $vendor->instagram }}">
                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/social-insta.svg') }}"
                                        alt="" />
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="vendor-info">
                        <ul class="font-sm mb-20">
                            <li><img class="mr-5"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                    alt="" /><strong>Địa chỉ: </strong> <span>{{ $vendor->address }}</span>
                            </li>
                            <li><img class="mr-5"
                                    src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                    alt="" /><strong>Liên hệ: </strong><a
                                    href="tel:{{ $vendor->phone }}">{{ $vendor->phone }}</a></li>
                        </ul>
                        <a href="mailto:{{ $vendor->email }}" class="btn btn-xs">Email </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
