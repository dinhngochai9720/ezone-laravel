@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Tìm kiếm {{ $item }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> {{ $item }}
        </div>
    </div>
</div>

<div class="container mb-30">
    <div class="row flex-row-reverse">
        <div class="col-lg-4-5">
            <div class="shop-product-fillter">
                <div class="totall-product">
                    <p>Tìm thấy <strong class="text-brand">{{ count($products) }}</strong> sản phẩm</p>
                </div>

                {{-- <div class="sort-by-product-area">
                    <div class="sort-by-cover mr-10">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps"></i>Show:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">50</a></li>
                                <li><a href="#">100</a></li>
                                <li><a href="#">150</a></li>
                                <li><a href="#">200</a></li>
                                <li><a href="#">All</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sort-by-cover">
                        <div class="sort-by-product-wrap">
                            <div class="sort-by">
                                <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                            </div>
                            <div class="sort-by-dropdown-wrap">
                                <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                            </div>
                        </div>
                        <div class="sort-by-dropdown">
                            <ul>
                                <li><a class="active" href="#">Featured</a></li>
                                <li><a href="#">Price: Low to High</a></li>
                                <li><a href="#">Price: High to Low</a></li>
                                <li><a href="#">Release Date</a></li>
                                <li><a href="#">Avg. Rating</a></li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row product-grid">

                @foreach ($products as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
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


                                <div>
                                    @if ($product->vendor_id == null)
                                        <span class="font-small text-muted">Nhà cung cấp <a
                                                href="{{ url('/') }}">Admin</a></span>
                                    @else
                                        <span class="font-small text-muted">Nhà cung cấp <a
                                                href="{{ route('vendor.details', $product->vendor_id) }}">{{ $product['vendor']['name'] }}</a></span>
                                        {{-- vendor is relationship in Product Model --}}
                                    @endif

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
                                        {{-- <a aria-label="Quick view" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{$product->id}}" onclick="productView(this.id)" class="add" ><i class="fi-rs-shopping-cart mr-5"></i>Add </a> --}}
                                        <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                            class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản phẩm</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!--end product card-->


            </div>
            <!--product grid-->
            {{-- <div class="pagination-area mt-20 mb-20">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-left"></i></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#"><i class="fi-rs-arrow-small-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div> --}}

            <!--End Deals-->


        </div>
        <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
            <div class="sidebar-widget widget-category-2 mb-30">
                <h5 class="section-title style-1 mb-30">Danh mục</h5>
                <ul>
                    @foreach ($categories as $category)
                        <li>

                            @php
                                $products = App\Models\Product::where('category_id', $category->id)->get();
                            @endphp

                            <a href="{{ url('product/category/' . $category->id . '/' . $category->category_slug) }}"> <img
                                    src="{{ asset($category->category_image) }}"
                                    alt="" />{{ $category->category_name }}</a><span
                                class="count">{{ count($products) }}</span>
                        </li>
                    @endforeach


                </ul>
            </div>

            <!-- Fillter By Price -->

            <!-- Product sidebar Widget -->
            <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                <h5 class="section-title style-1 mb-30">Sản phẩm mới</h5>

                @foreach ($new_products as $product)
                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{ asset($product->product_thumbnail) }}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <p><a
                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">{{ $product->product_name }}</a>
                            </p>
                            @if ($product->discount_price == null || $product->discount_price == 0)
                                <p class="price mb-0 mt-5">{{ number_format($product->selling_price, 0, '.', '.') }}₫
                                </p>
                            @else
                                <p class="price mb-0 mt-5">{{ number_format($product->discount_price, 0, '.', '.') }}₫
                                </p>
                            @endif


                            @php
                                $arvarage = App\Models\Review::where('product_id', $product->id)
                                    ->where('status', 1)
                                    ->avg('rating');
                            @endphp
                            <div class="product-rate">
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
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
