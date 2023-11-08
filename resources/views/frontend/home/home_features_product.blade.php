@php
    $featured = App\Models\Product::where('featured', 1)
        ->where('status', 1)
        ->orderBy('created_at', 'DESC')
        ->limit(8)
        ->get();
    
    $banner = App\Models\Banner::orderBy('created_at', 'DESC')->first();
    
@endphp


<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Sản phẩm đặc sắc </h3>

        </div>
        <div class="row">


            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2"
                    style="background: url({{ asset($banner->banner_image) }}) no-repeat center bottom;  background-size: cover;">
                    <div class="banner-text">
                        <h2 class="mb-100">{{ $banner->banner_title }}</h2>
                        <a href="{{ $banner->banner_url }}" class="btn btn-xs">Sản phẩm <i
                                class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>



            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow"
                                id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">


                                @foreach ($featured as $product)
                                    <div class="product-cart-wrap">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a
                                                    href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                    <img class="default-img"
                                                        src="{{ asset($product->product_thumbnail) }}" alt="" />

                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Xem nhanh" class="action-btn small hover-up"
                                                    data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                                    id="{{ $product->id }}" onclick="productView(this.id)"> <i
                                                        class="fi-rs-eye"></i></a>
                                                <a aria-label="Yêu thích" class="action-btn small hover-up"
                                                    id="{{ $product->id }}" onclick="addToWishList(this.id)"><i
                                                        class="fi-rs-heart"></i></a>
                                                <a aria-label="So sánh"
                                                    class="action-btn small hover-up"id="{{ $product->id }}"
                                                    onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>
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

                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Xem
                                                sản phẩm</a>
                                        </div>
                                    </div>
                                @endforeach
                                <!--End product Wrap-->
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
