@extends('frontend.master_dashboard')
@section('main')

@section('title')
    {{ $product->product_name }}
@endsection


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> <a
                href="{{ url('product/category/' . $product->category_id . '/' . $product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
            <span></span>
            <a
                href="{{ url('product/subcategory/' . $product->subcategory_id . '/' . $product['subcategory']['subcategory_slug']) }}">{{ $product['subcategory']['subcategory_name'] }}</a><span></span>
            {{ $product->product_name }}
        </div>
    </div>
</div>


{{-- <div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{url('/')}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> <a href="{{url('product/category/'.$product->category_id.'/'.$product['category']['category_slug'])}}">{{$product['category']['category_name']}}</a> <span></span> 
            <a href="{{url('product/subcategory/'.$product->subcategory_id.'/'.$product['subcategory']['subcategory_slug'])}}">{{$product['subcategory']['subcategory_name']}}</a><span></span> {{$product->product_name}}
        </div>
    </div>
</div> --}}

<div class="container mb-30">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <div class="product-detail accordion-detail">
                <div class="row mb-50 mt-30">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">

                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">

                                @foreach ($multiImage as $img)
                                    <figure class="border-radius-10">
                                        <img src="{{ asset($img->photo_name) }}" alt="product image" />
                                    </figure>
                                @endforeach


                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails">
                                @foreach ($multiImage as $img)
                                    <div><img src="{{ asset($img->photo_name) }}" alt="product image" /></div>
                                @endforeach
                            </div>
                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">

                            @if ($product->product_qty > 0)
                                <span class="stock-status in-stock"> Có sẵn </span>
                            @else
                                <span class="stock-status out-stock"> Hết hàng </span>
                            @endif


                            <h2 class="title-detail" id="details_p_name">{{ $product->product_name }}</h2>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">

                                    @php
                                        $arvarage = App\Models\Review::where('product_id', $product->id)
                                            ->where('status', 1)
                                            ->avg('rating');
                                        
                                        $reviewcount = App\Models\Review::where('product_id', $product->id)
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

                            <div class="clearfix product-price-cover">

                                @php
                                    $amount = $product->selling_price - $product->discount_price;
                                    
                                    if ($amount < 0) {
                                        $discount = abs($amount / $product->selling_price) * 100;
                                    } else {
                                        $discount = ($amount / $product->selling_price) * 100;
                                    }
                                @endphp

                                @if ($product->discount_price == $product->selling_price)
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">
                                            {{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                    </div>
                                @else
                                    <div class="product-price primary-color float-left">
                                        <span class="current-price text-brand">
                                            {{ number_format($product->discount_price, 0, '.', '.') }}₫</span>

                                        <span>
                                            <span class="save-price font-md color3 ml-15">
                                                @if ($product->discount_price == $product->selling_price)
                                                @elseif ($product->discount_price > $product->selling_price)
                                                    <span style="color: #f74b81">
                                                        <i class="fa-solid fa-arrow-up"></i>
                                                        {{ round($discount) }}%</span>
                                                @else
                                                    <span style="color: #3BB77E">
                                                        <i class="fa-solid fa-arrow-down"></i>
                                                        {{ round($discount) }}%</span>
                                                @endif
                                            </span>

                                            <span class="old-price font-md ml-15">
                                                {{ number_format($product->selling_price, 0, '.', '.') }}₫
                                            </span>
                                        </span>
                                    </div>
                                @endif


                            </div>
                            <div class="short-desc mb-30">
                                <p class="font-lg">{{ $product->short_description }}</p>
                            </div>


                            @if ($product->product_size == null)
                            @else
                                <div class="attr-detail attr-size mb-30" style="width: 50%">
                                    <strong class="mr-10">Size: </strong>
                                    <select class="form-control unicase-form-control" id="details_size">
                                        {{-- <option selected disabled>-----------Choose size-----------</option> --}}
                                        @foreach ($product_size as $size)
                                            <option value="{{ $size }}">{{ ucwords($size) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif


                            @if ($product->product_color == null)
                            @else
                                <div class="attr-detail attr-size mb-30" style="width: 50%">
                                    <strong class="mr-10">Màu: </strong>
                                    <select class="form-control unicase-form-control" id="details_color">
                                        {{-- <option selected disabled>---------Choose color---------</option> --}}
                                        @foreach ($product_color as $color)
                                            <option value="{{ $color }}">{{ ucwords($color) }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            @endif



                            <div class="detail-extralink mb-50">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input id="details_qty" type="text" name="quantity" class="qty-val"
                                        value="1" min="1">
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">

                                    <input type="hidden" id="details_product_id" value="{{ $product->id }}" />
                                    <input type="hidden" id="details_product_vendor_id"
                                        value="{{ $product->vendor_id }}" />


                                    @if ($product->product_qty == 0)
                                        <button disabled type="submit" class="button button-add-to-cart"
                                            onclick="addToCartProductDetails()"><i class="fi-rs-shopping-cart"></i>Thêm
                                            vào giỏ hàng</button>
                                    @else
                                        <button type="submit" class="button button-add-to-cart"
                                            onclick="addToCartProductDetails()"><i class="fi-rs-shopping-cart"></i>Thêm
                                            vào giỏ hàng</button>
                                    @endif

                                    <a aria-label="Yêu thích" class="action-btn hover-up" id="{{ $product->id }}"
                                        onclick="addToWishList(this.id)"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="So sánh" class="action-btn hover-up" id="{{ $product->id }}"
                                        onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
                                </div>
                            </div>

                            @if ($product->vendor_id == null)
                                <h6 class="mb-4 ">Nhà cung cấp <a href="{{ url('/') }}"><span
                                            class="text-danger">Admin</span></a> </h6>
                            @else
                                <h6 class="mb-4 ">Nhà cung cấp <a
                                        href="{{ route('vendor.details', $product->vendor_id) }}"><span
                                            class="text-danger">{{ $product['vendor']['name'] }}</span></a></h6>
                            @endif

                            <hr />


                            <div class="font-xs">
                                <ul class="mr-50 float-start">

                                    {{-- Solution 1: --}}
                                    {{-- @php
                                $brands= App\Models\Brand::where('id',$product->brand_id)->get();
                                // echo $brands;
                            @endphp
                            @foreach ($brands as $brand)
                                    <li class="mb-5">Brand: <span class="text-brand">{{$brand->brand_name}}</span></li>
                            @endforeach  --}}

                                    {{-- Solution 2: --}}
                                    <li class="mb-5">Thương hiệu: <span
                                            class="text-brand">{{ $product['brand']['brand_name'] }}</span></li>


                                    <li class="mb-5">Danh mục:<span class="text-brand">
                                            {{ $product['category']['category_name'] }}</span></li>
                                    <li>Danh mục con: <span
                                            class="text-brand">{{ $product['subcategory']['subcategory_name'] }}</span>
                                    </li>
                                </ul>
                                <ul class="float-start">
                                    <li class="mb-5">Code: <span
                                            class="text-brand">{{ $product->product_code }}</span></li>
                                    <li class="mb-5">Tags: <span
                                            class="text-brand">{{ strtolower($product->product_tags) }}</span></li>
                                    <li>Số lượng:<span
                                            class="in-stock text-brand ml-5">{{ $product->product_qty }}</span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
                <div class="product-info">
                    <div class="tab-style3">
                        <ul class="nav nav-tabs text-uppercase">
                            <li class="nav-item">
                                <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                    href="#Description">Miêu tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                                    href="#Additional-info">Thông tin sản phẩm</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab"
                                    href="#Vendor-info">Nhà cung cấp</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Đánh giá
                                    ({{ count($reviewcount) }})</a>
                            </li>
                        </ul>
                        <div class="tab-content shop_info_tab entry-main-content">
                            <div class="tab-pane fade show active" id="Description">
                                <div class="">
                                    <p>{!! $product->long_description !!}</p>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="Additional-info">

                                <table class="font-md">
                                    <tbody>
                                        <tr class="stand-up">
                                            <th>Danh mục</th>
                                            <td>
                                                <p>{{ $product['category']['category_name'] }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Danh mục con</th>
                                            <td>
                                                <p>{{ $product['subcategory']['subcategory_name'] }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Thương hiệu</th>
                                            <td>
                                                <p>{{ $product['brand']['brand_name'] }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Nhà cung cấp</th>
                                            <td>
                                                @if ($product->vendor_id == null)
                                                    Owner
                                                @else
                                                    <p>{{ $product['vendor']['name'] }}</p>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Tên sản phẩm</th>
                                            <td>
                                                <p>{{ $product->product_name }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Code</th>
                                            <td>
                                                <p>{{ $product->product_code }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Tags</th>
                                            <td>
                                                <p>{{ strtolower($product->product_tags) }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Sizes</th>
                                            <td>
                                                <p>{{ $product->product_size }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Màu</th>
                                            <td>
                                                <p>{{ $product->product_color }}</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Giá ban đầu</th>
                                            <td>
                                                <p>{{ number_format($product->selling_price, 0, '.', '.') }}₫</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Giảm giá</th>
                                            <td>
                                                <p>{{ number_format($product->discount_price, 0, '.', '.') }}₫</p>
                                            </td>
                                        </tr>

                                        <tr class="stand-up">
                                            <th>Miêu tả ngắn</th>
                                            <td>
                                                <p>{{ $product->short_description }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                            <div class="tab-pane fade" id="Vendor-info">
                                <div class="vendor-logo d-flex mb-30">
                                    <img src="{{ !empty($product->vendor->photo) ? url($product->vendor->photo) : url('upload/no_image.jpg') }}"
                                        alt="" />
                                    <div class="vendor-name ml-15">

                                        @if ($product->vendor_id == null)
                                            <h6>
                                                <a href="{{ url('/') }}">Admin</a>
                                            </h6>
                                        @else
                                            <h6>
                                                <a
                                                    href="{{ route('vendor.details', $product->vendor_id) }}">{{ $product['vendor']['name'] }}</a>
                                            </h6>
                                        @endif

                                        <div class="product-rate-cover text-end">
                                            @php
                                                $arvarage_vendor = App\Models\Review::where('vendor_id', $product->vendor_id)
                                                    ->where('status', 1)
                                                    ->avg('rating');
                                                
                                                $reviewcount_vendor = App\Models\Review::where('vendor_id', $product->vendor_id)
                                                    ->where('status', 1)
                                                    ->get();
                                            @endphp

                                            <div class="product-rate d-inline-block">
                                                @if ($product->vendor_id == null)
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

                                            <span class="font-small ml-5 text-muted">
                                                ({{ count($reviewcount_vendor) }} đánh giá)</span>
                                        </div>
                                    </div>
                                </div>

                                @if ($product->vendor == null)
                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                alt="" /><strong>Địa chỉ: </strong> <span>55 Giải Phóng,
                                                Hai Bà Trưng, Hà Nội</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                alt="" /><strong>Trung tâm hỗ trợ 24/7: </strong>
                                            <a href="tel:19006789"><span>1900-6789</span></a>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}"
                                                alt="" /><strong>Địa chỉ: </strong>
                                            <span>{{ $product['vendor']['address'] }}</span></li>
                                        <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}"
                                                alt="" /><strong>Liên hệ: </strong>
                                            <a
                                                href="tel:{{ $product['vendor']['phone'] }}"><span>{{ $product['vendor']['phone'] }}</span></a>
                                        </li>
                                    </ul>
                                @endif


                                @if ($product->vendor == null)
                                    <p>Trung tâm hỗ trợ 24/7</p>
                                @else
                                    <p>{{ $product['vendor']['vendor_short_info'] }}</p>
                                @endif

                            </div>
                            <div class="tab-pane fade" id="Reviews">
                                <!--Comments-->
                                <div class="comments-area">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h4 class="mb-30">Đánh giá sản phẩm</h4>
                                            <div class="comment-list">

                                                @php
                                                    $reviews = App\Models\Review::where('product_id', $product->id)
                                                        ->where('status', 1)
                                                        ->latest()
                                                        ->get();
                                                @endphp

                                                @foreach ($reviews as $review)
                                                    @if ($review->status == 0)
                                                    @else
                                                        <div
                                                            class="single-comment justify-content-between d-flex mb-30">
                                                            <div class="user justify-content-between d-flex">
                                                                <div class="thumb text-center">
                                                                    <img src="{{ !empty($review['user']['photo']) ? url($review['user']['photo']) : url('upload/no_image.jpg') }}"
                                                                        alt="" />
                                                                    <a href="#"
                                                                        class="font-heading text-brand">{{ $review['user']['fullname'] }}</a>
                                                                </div>
                                                                <div class="desc">
                                                                    <div class="d-flex justify-content-between mb-10">
                                                                        <div class="d-flex align-items-center">
                                                                            <span
                                                                                class="font-xs text-muted">{{ Carbon\Carbon::parse($review->created_at)->locale('vi')->diffForHumans() }}
                                                                            </span>
                                                                        </div>
                                                                        <div class="product-rate d-inline-block">

                                                                            @if ($review->rating == null)
                                                                            @elseif($review->rating == 1)
                                                                                <div class="product-rating"
                                                                                    style="width: 20%"></div>
                                                                            @elseif($review->rating == 2)
                                                                                <div class="product-rating"
                                                                                    style="width: 40%"></div>
                                                                            @elseif($review->rating == 3)
                                                                                <div class="product-rating"
                                                                                    style="width: 60%"></div>
                                                                            @elseif($review->rating == 4)
                                                                                <div class="product-rating"
                                                                                    style="width: 80%"></div>
                                                                            @elseif($review->rating == 5)
                                                                                <div class="product-rating"
                                                                                    style="width: 100%"></div>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <p class="mb-10">{{ $review->comment }}
                                                                        {{-- <a href="#" class="reply">Reply</a> --}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach

                                            </div>
                                        </div>

                                        {{-- <div class="col-lg-4">
                                            <h4 class="mb-30">Customer reviews</h4>
                                            <div class="d-flex mb-30">
                                                <div class="product-rate d-inline-block mr-15">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <h6>4.8 out of 5</h6>
                                            </div>

                                            <div class="progress">
                                                <span>5 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                            </div>
                                            
                                            <div class="progress">
                                                <span>4 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                            <div class="progress">
                                                <span>3 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                            </div>
                                            <div class="progress">
                                                <span>2 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                            </div>
                                            <div class="progress mb-30">
                                                <span>1 star</span>
                                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                            </div>
                                            <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
                                        </div> --}}
                                    </div>
                                </div>

                                <!--comment form-->
                                <div class="comment-form">
                                    <h4 class="mb-15">Thêm đánh giá</h4>
                                    @guest

                                        <p>
                                            <b>Vui lòng đăng nhập trước khi đánh giá sản phẩm!</b>
                                            <a href="{{ route('login') }}">Đăng nhập</a>
                                        </p>
                                    @else
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form method="POST" action="{{ route('store.review') }}"
                                                    class="form-contact comment_form" id="commentForm">
                                                    @csrf
                                                    <div class="row">

                                                        <input type="hidden" name="product_id"
                                                            value="{{ $product->id }}" />
                                                        @if ($product->vendor_id == null)
                                                            <input type="hidden" name="rv_vendor_id" value="" />
                                                        @else
                                                            <input type="hidden" name="rv_vendor_id"
                                                                value="{{ $product->vendor_id }}" />
                                                        @endif

                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="cell-level">&nbsp;</th>
                                                                    <th>1 sao</th>
                                                                    <th>2 sao</th>
                                                                    <th>3 sao</th>
                                                                    <th>4 sao</th>
                                                                    <th>5 sao</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <tr>
                                                                    <td class="cell-level">Chất lượng</td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="1"
                                                                            style="width: 20px; height: 20px;" /></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="2"
                                                                            style="width: 20px; height: 20px;" /></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="3"
                                                                            style="width: 20px; height: 20px;" /></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="4"
                                                                            style="width: 20px; height: 20px;" /></td>
                                                                    <td><input type="radio" name="quality"
                                                                            class="radio-sm" value="5"
                                                                            style="width: 20px; height: 20px;" /></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>


                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="12"
                                                                    placeholder="Viết đánh giá"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit"
                                                            class="button button-contactForm">Gửi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    @endguest



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-60">
                    <div class="col-12">
                        <h2 class="section-title style-1 mb-30">Sản phẩm liên quan</h2>
                    </div>
                    <div class="col-12">
                        <div class="row related-products">

                            @foreach ($related_products as $product)
                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                    tabindex="0">
                                                    <img class="default-img"
                                                        src="{{ asset($product->product_thumbnail) }}"
                                                        alt="" />
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Xem nhanh" class="action-btn small hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                    id="{{ $product->id }}" onclick="productView(this.id)"><i
                                                        class="fi-rs-search"></i></a>
                                                <a aria-label="Yêu thích" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToWishList(this.id)"
                                                    tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="So sánh" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToCompare(this.id)"
                                                    tabindex="0"><i class="fi-rs-shuffle"></i></a>
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
                                            <h2><a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                    tabindex="0">{{ $product->product_name }}</a></h2>

                                            @php
                                                $arvarage = App\Models\Review::where('product_id', $product->id)
                                                    ->where('status', 1)
                                                    ->avg('rating');
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

                                            {{-- <div class="rating-result" title="90%">
                                            <span> </span>
                                        </div> --}}

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
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
