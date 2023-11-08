@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Ezone
@endsection


@include('frontend.home.home_slider')
<!--End hero slider-->

@include('frontend.home.home_features_category')
<!--End category slider-->

@include('frontend.home.home_banner')
<!--End banners-->



@include('frontend.home.home_new_product')
<!--Products Tabs-->



@include('frontend.home.home_features_product')
<!--End Best Sales-->

<!-- Skip Category 0 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_0->category_name }}</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">


                    @forelse ($skip_products_0 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
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
                                        <a aria-label="So sánh" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;

                                        if ($amount < 0) {
                                            $discount = abs($amount / $product->selling_price) * 100;
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



                                    @if ($product->vendor == null)
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ url('/') }}">Admin</a></span>
                                        </div>
                                    @else
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ route('vendor.details', $product->vendor_id) }}">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                    @endif

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
                                            {{-- <a aria-label="Quick view" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="add" ><i class="fi-rs-shopping-cart mr-5"></i>Xem sản phẩm </a> --}}
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản
                                                phẩm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->

                    @empty
                        <h3 class="text-secondary text-center">Không tìm thấy sản phẩm</h3>
                    @endforelse


                </div>
                <!--End product-grid-4-->
            </div>


        </div>
        <!--End tab-content-->
    </div>


</section>
<!--End Skip Category 0 -->





<!-- Skip Category 1-->

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_1->category_name }}</h3>


        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">



                    @forelse ($skip_products_1 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
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
                                        <a aria-label="So sánh" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;

                                        if ($amount < 0) {
                                            $discount = abs($amount / $product->selling_price) * 100;
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



                                    @if ($product->vendor == null)
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ url('/') }}">Admin</a></span>
                                        </div>
                                    @else
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ route('vendor.details', $product->vendor_id) }}">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                    @endif

                                    <div class="product-card-bottom">
                                        @if ($product->discount_price == $product->selling_price)
                                            <div class="product-price">
                                                <span>{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>

                                            </div>
                                        @else
                                            <div class="product-price">
                                                <span>{{ number_format($product->discount_price, 0, '.', '.') }}₫
                                                </span>
                                                <span
                                                    class="old-price">{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="product-card-bottom">
                                        <div class="add-cart">
                                            {{-- <a  aria-label="Quick view" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản phẩm </a> --}}
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản
                                                phẩm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->

                    @empty
                        <h3 class="text-secondary text-center">Không tìm thấy sản phẩm</h3>
                    @endforelse
                    <!--end product card-->



                </div>
                <!--End product-grid-4-->
            </div>


        </div>
        <!--End tab-content-->
    </div>
</section>
<!--End Skip Category 1-->








<!-- Skip Category 2 -->
<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{ $skip_category_2->category_name }}</h3>

        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">


                    @forelse ($skip_products_2 as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
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
                                        <a aria-label="So sánh" class="action-btn" id="{{ $product->id }}"
                                            onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                        <a aria-label="Xem nhanh" class="action-btn" data-bs-toggle="modal"
                                            data-bs-target="#quickViewModal" id="{{ $product->id }}"
                                            onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                    </div>

                                    @php
                                        $amount = $product->selling_price - $product->discount_price;

                                        if ($amount < 0) {
                                            $discount = abs($amount / $product->selling_price) * 100;
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



                                    @if ($product->vendor == null)
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ url('/') }}">Admin</a></span>
                                        </div>
                                    @else
                                        <div>
                                            <span class="font-small text-muted">Nhà cung cấp <a
                                                    href="{{ route('vendor.details', $product->vendor_id) }}">{{ $product['vendor']['name'] }}</a></span>
                                        </div>
                                    @endif

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
                                            {{-- <a aria-label="Quick view" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="add" ><i class="fi-rs-shopping-cart mr-5"></i>Xem sản phẩm </a> --}}
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản
                                                phẩm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end product card-->

                    @empty
                        <h3 class="text-secondary text-center">Không tìm thấy sản phẩm</h3>
                    @endforelse
                </div>
                <!--End product-grid-4-->
            </div>


        </div>
        <!--End tab-content-->
    </div>

</section>
<!--End Skip Category 2 -->


<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Ưu đãi lớn </h4>
                <div class="product-list-small animated animated">


                    @forelse ($hot_deals as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                        src="{{ asset($product->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h6>


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


                                @if ($product->discount_price == $product->selling_price)
                                    <div class="product-price">
                                        <span>{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>

                                    </div>
                                @else
                                    <div class="product-price">
                                        <span>{{ number_format($product->discount_price, 0, '.', '.') }}₫
                                        </span>
                                        <span
                                            class="old-price">{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                    </div>
                                @endif


                            </div>
                        </article>

                    @empty

                        <h6 class="text-secondary text-center">Không tìm thấy sản phẩm</h6>
                    @endforelse

                </div>
            </div>



            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp"
                data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Đề nghị đặc biệt </h4>
                <div class="product-list-small animated animated">
                    @forelse ($special_offer as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                        src="{{ asset($product->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h6>


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
                        </article>

                    @empty

                        <h6 class="text-secondary text-center">Không tìm thấy sản phẩm</h6>
                    @endforelse

                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Sản phẩm mới</h4>
                <div class="product-list-small animated animated">

                    @forelse ($recently_added as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                        src="{{ asset($product->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h6>

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
                        </article>

                    @empty

                        <h6 class="text-secondary text-center">Không tìm thấy sản phẩm</h6>
                    @endforelse

                </div>
            </div>

            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp"
                data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Ưu đãi đặc biệt </h4>
                <div class="product-list-small animated animated">
                    @forelse ($special_deals as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"><img
                                        src="{{ asset($product->product_thumbnail) }}" alt="" /></a>
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a
                                        href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                                </h6>

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
                        </article>

                    @empty
                        <h6 class="text-secondary text-center">Không tìm thấy sản phẩm</h6>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->

<!--Vendor List -->
@include('frontend.home.home_vendor_list')
<!--End Vendor List -->
@endsection
