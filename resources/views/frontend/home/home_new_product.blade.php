@php
    $products = App\Models\Product::where('status', 1)
        ->orderBy('created_at', 'DESC')
        ->limit(10)
        ->get();
    
    $categories = App\Models\Category::orderBy('category_name', 'ASC')
        ->limit(6)
        ->get();
    
@endphp

<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> Sản phẩm mới </h3>
            <ul class="nav nav-tabs links" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one"
                        type="button" role="tab" aria-controls="tab-one" aria-selected="true">Tất cả</button>
                </li>

                @foreach ($categories as $category)
                    <li class="nav-item" role="presentation">
                        <a href="#category{{ $category->id }}" class="nav-link" id="nav-tab-two" data-bs-toggle="tab"
                            type="button" role="tab" aria-controls="tab-two"
                            aria-selected="false">{{ $category->category_name }}</a>
                    </li>
                @endforeach

            </ul>
        </div>

        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">

                    @foreach ($products as $product)
                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s">
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

                                        {{-- Solution 1: --}}
                                        {{-- @php
                                                $categories= App\Models\Brand::where('id',$product->category_id)->get();
                                                // echo $brand;
                                            @endphp
                                            @foreach ($categories as $category)
                                                 <a href="shop-grid-right.html">{{$category->category_name}}</a>
                                            @endforeach --}}

                                        {{-- Solution 2: --}}
                                        {{-- category is relationship in Product Model --}}
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
                                        @if ($product->selling_price === $product->discount_price)
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
                                            <input type="hidden" />
                                            <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản
                                                phẩm</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!--end product card-->

                </div>
                <!--End product-grid-4-->
            </div>
            <!--En tab one-->


            @foreach ($categories as $category)
                <div class="tab-pane fade" id="category{{ $category->id }}" role="tabpanel"
                    aria-labelledby="tab-two">
                    <div class="row product-grid-4">


                        @php
                            $products = App\Models\Product::where('category_id', $category->id)
                                ->orderBy('created_at', 'DESC')
                                ->limit(5)
                                ->get();
                        @endphp


                        @forelse ($products as $product)
                            <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                                <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                    data-wow-delay=".1s">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a
                                                href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}">
                                                <img class="default-img"
                                                    src="{{ asset($product->product_thumbnail) }}" alt="" />

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

                                            {{-- Solution 1: --}}
                                            {{-- @php
                                        $categories= App\Models\Brand::where('id',$product->category_id)->get();
                                        // echo $brand;
                                    @endphp
                                    @foreach ($categories as $category)
                                         <a href="shop-grid-right.html">{{$category->category_name}}</a>
                                    @endforeach --}}

                                            {{-- Solution 2: --}}
                                            <a
                                                href="{{ url('product/category/' . $product->category_id . '/' . $product['category']['category_slug']) }}">{{ $product['category']['category_name'] }}</a>
                                            {{-- category is relationship in Product Model --}}


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

                                            <span class="font-small ml-5 text-muted">
                                                ({{ count($reviewcount) }})</span>
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
                                                    <span>
                                                        {{ number_format($product->discount_price, 0, '.', '.') }}₫</span>
                                                    <span
                                                        class="old-price">{{ number_format($product->selling_price, 0, '.', '.') }}₫</span>
                                                </div>
                                            @endif

                                        </div>


                                        <div class="product-card-bottom">
                                            <div class="add-cart">
                                                <input type="hidden" />
                                                <a href="{{ url('product/details/' . $product->id . '/' . $product->product_slug) }}"
                                                    class="add"><i class="fi-rs-shopping-cart mr-5"></i>Xem sản
                                                    phẩm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @empty
                            <h3 class="text-secondary text-center">Không tìm thấy sản phẩm</h3>
                        @endforelse
                        <!--end product card-->

                    </div>
                    <!--End product-grid-4-->
                </div>
                <!--En tab two-->
            @endforeach


        </div>
        <!--End tab-content-->
    </div>
</section>
