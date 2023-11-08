<!DOCTYPE html>
<html class="no-js" lang="en">

@php
    $seo = App\Models\Seo::find(1);
@endphp

<head>
    <meta charset="utf-8" />
    <title> @yield('title')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />


    <meta name="title" content="{{ $seo->meta_title }}" />
    <meta name="author" content="{{ $seo->meta_author }}" />
    <meta name="keyword" content="{{ $seo->meta_keyword }}" />
    <meta name="description" content="{{ $seo->meta_description }}" />

    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon"
        href="{{ asset('frontend/assets/imgs/theme/customize/favicon.webp') }}" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/plugins/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />

    {{-- Font Awesome CND --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Toast --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


    {{-- Stripe Payment --}}
    <script src="https://js.stripe.com/v3/"></script>

    {{-- Slider filter price --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" type="text/css"
        media="all" />
</head>

<body>
    <!-- Modal -->
    <!-- Quick view -->
    @include('frontend.body.quickview')
    <!-- Header  -->
    @include('frontend.body.header')
    <!-- End Header  -->

    <main class="main">
        @yield('main')
    </main>


    @include('frontend.body.footer')

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <img src="{{ asset('frontend/assets/imgs/theme/customize/loading.gif') }}" alt="" />
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor JS-->
    <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>

    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    {{-- Search product --}}
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Validate --}}
    <script src="{{ asset('adminbackend/assets/js/validate.min.js') }}"></script>

    {{-- Toastr Notification --}}
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- Slider price --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
            }
        })

        // Show product with quickview
        function productView(id) {
            // alert(id); // id of product
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    // Display the data from ajax to quickview.balde.php
                    $('#p_name').text(data.product.product_name);
                    $('#p_name').attr('href', 'product/details/' + data.product.id + '/' + data.product
                        .product_slug);
                    $('#p_code').text(data.product.product_code);
                    $('#p_category').text(data.product.category.category_name);

                    $('#p_vendor_id').text(data.product.vendor_id);

                    $('#p_vendor_name').text(data.product.vendor.name);

                    $('#p_brand').text(data.product.brand.brand_name);
                    $('#p_image').attr('src', '/' + data.product.product_thumbnail);

                    // Get id of product 
                    $('#product_id').val(id);

                    // Defaults quantity product in quickview
                    $('#q_ty').val(1);



                    // Price
                    if (data.product.discount_price == data.product.selling_price) {
                        $('#p_discount_price').text(Number(data.product.selling_price).toLocaleString('vi-VN', {
                            minimumFractionDigits: 0
                        }) + '₫');
                        $('#p_selling_price').text('');
                    } else {
                        $('#p_discount_price').text(Number(data.product.discount_price).toLocaleString(
                            'vi-VN', {
                                minimumFractionDigits: 0
                            }) + '₫');
                        $('#p_selling_price').text(Number(data.product.selling_price).toLocaleString('vi-VN', {
                            minimumFractionDigits: 0
                        }) + '₫');

                    }

                    // Quantity
                    if (data.product.product_qty > 0) {
                        $('#p__qty_outstock').text('');
                        // $('#p__qty_available').text('');
                        $('#p__qty_available').text('có sẵn');

                        $('#quickview_button').attr("disabled", false);

                    } else {
                        $('#p__qty_available').text('');
                        // $('#p__qty_outstock').text('');
                        $('#p__qty_outstock').text('hết hàng');

                        $('#quickview_button').attr("disabled", true);

                    }

                    // Size
                    $('select[name="p_size"]').empty();
                    $.each(data.size, function(key, value) {
                        $('select[name="p_size"]').append('<option value="' + value + '">' + value +
                            '</option>')

                        if (data.size == "") {
                            $('#p_size_area').hide();
                        } else {
                            $('#p_size_area').show();
                        }
                    })

                    // Color
                    $('select[name="p_color"]').empty();
                    $.each(data.color, function(key, value) {
                        $('select[name="p_color"]').append('<option value="' + value + '">' + value +
                            '</option>')

                        if (data.color == "") {
                            $('#p_color_area').hide();
                        } else {
                            $('#p_color_area').show();
                        }
                    })
                }
            })
        }

        // Add product to cart from button in quickview
        function addToCartQuickView() {
            // Get data product to add to cart
            var product_name = $('#p_name').text();
            var product_id = $('#product_id').val();
            var vendor_id = $('#p_vendor_id').text();
            var product_color = $('#p_color option:selected').text();
            var product_size = $('#p_size option:selected').text();
            var product_qty = $('#q_ty').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    color: product_color,
                    size: product_size,
                    quantity: product_qty,
                    name_product: product_name,
                    id_of_vendor: vendor_id
                },
                url: "/cart/data/store/" + product_id,
                success: function(data) {
                    // console.log(data);

                    // update price 
                    calculateCoupon();

                    // update product in mini cart
                    miniCart();
                    $('#closeModal').click(); // close quuickview modal after add to cart

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }


            })
        }

        // Add product to cart from button in product details
        function addToCartProductDetails() {
            // Get data to add to cart
            var product_name = $('#details_p_name').text();
            var product_id = $('#details_product_id').val();
            var vendor_id = $('#details_product_vendor_id').val();
            var product_color = $('#details_color option:selected').text();
            var product_size = $('#details_size option:selected').text();
            var product_qty = $('#details_qty').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    color: product_color,
                    size: product_size,
                    quantity: product_qty,
                    name_product: product_name,
                    id_of_vendor: vendor_id
                },
                url: "/details-cart/data/store/" + product_id,
                success: function(data) {
                    // console.log(data);

                    // update price
                    calculateCoupon();

                    // update product mini cart
                    miniCart();
                    $('#closeModal').click(); // close quickview modal after add to cart


                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>


    <script type="text/javascript">
        // Show product on mini cart
        function miniCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function(data) {
                    // console.log(data);

                    $('span[id="cart_subtotal"]').text(Number(data.cart_total).toLocaleString('vi-VN', {
                        minimumFractionDigits: 0
                    }) + '₫');

                    $('#cart_qty').text(data.cart_qty);

                    var miniCart = '';

                    $.each(data.carts, function(key, value) {
                        miniCart += `
                            <ul style="margin-bottom:10px;">
                                    <li style="width:100%;">
                                        <div class="shopping-cart-img" style="height:100%;">
                                <a href="/product/details/${value.id}/${value.name.toLowerCase().trim().replace(/[^\w-]+/g, "-")}" ><img alt="Nest" src="/${value.options.image}" 
                                    style="width:80px; height:100%; border-radius:5px;"
                                    /></a>
                                        </div>
                                        <div class="shopping-cart-title" style="margin: -88px 0px 0px 100px;width:150px;">
                                            <h4 style="font-size:14px;"><a href="/product/details/${value.id}/${value.name.toLowerCase().trim().replace(/[^\w-]+/g, "-")}">${value.name}</a></h4>
                                            <h4 style="font-size:14px;"><span>${value.qty} × </span>${Number(value.price).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                        </div>
                                        <div class="shopping-cart-delete" style="margin-top:-90px;">
                                            <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                            `
                    });
                    $('#mini_cart').html(miniCart);
                }
            })
        }
        miniCart();

        // Remove product on mini cart
        function miniCartRemove(rowId) {
            $.ajax({
                type: "GET",
                url: "/minicart/product/remove/" + rowId,
                dataType: 'json',
                success: function(data) {
                    // update cart after remove product on mini cart
                    cart();

                    // update mini cart
                    miniCart();

                    // update price
                    calculateCoupon();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>


    <script type="text/javascript">
        //  Add product to Wishlist
        function addToWishList(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/add-to-wishlist/' + product_id,
                success: function(data) {

                    // Update the wishlist after add product to wishlist
                    wishlist()

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>


    <script type="text/javascript">
        // Load data for  Wishlist
        function wishlist() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/get-product-wishlist',
                success: function(data) {
                    // console.log(data);

                    // Number of elements in object
                    // console.log(Object.keys(data).length);

                    // qty in view wishlist in wishlist page
                    var text = '';
                    text +=
                        `<span >Có <span style="color:#3BB77E; "> ${Object.keys(data).length}</span> sản phẩm trong danh sách yêu thích của bạn</span>`;
                    $('#wishlist_qty').html(text);

                    // qty in icon wishlist in header
                    var infor = '';
                    infor += `${Object.keys(data).length}`
                    $('#qty_wishlist').html(infor);

                    var rows = '';

                    $.each(data, function(key, value) {
                        rows +=
                            `
                                <tr class="pt-30">
                                        <td class="custome-checkbox pl-30">
                                        
                                        </td>
                                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thumbnail}" alt="#" /></td>
                                        <td class="product-des product-name">
                                            <h6><a class="product-name mb-10" href="/product/details/${value.product.id}/${value.product.product_name.toLowerCase().trim().replace(/[^\w-]+/g, "-")}">${value.product.product_name}</a></h6>


                                        </td>
                                        <td class="price" data-title="Price">
                                    
                                            <h3 class="text-brand">
                                                ${Number(value.product.discount_price).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}
                                            </h3>
                                        
                                        
                                        </td>
                                        <td class="text-center detail-info" data-title="Stock">
                                            ${value.product.product_qty > 0
                                            ?
                                            `
                                                                                <span class="stock-status in-stock mb-0"> Có sẵn </span>
                                                                                `
                                            :
                                            `
                                                                                <span class="stock-status out-stock mb-0"> Hết hàng </span>
                                                                                `
                                        }
                                        
                                        </td>
                                    
                                        <td class="action text-center" data-title="Remove">
                                            <a title="xóa" type="submit" id="${value.id}" onclick="wishlistRemove(this.id)" class="text-body"><i class="fi-rs-trash" style="color:#f41127;"></i></a>
                                        </td>
                                    </tr>

                                `
                    });

                    $('#wishlist').html(rows);
                }
            })
        }
        wishlist();


        // Remove product from wishlist
        function wishlistRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/remove-product-wishlist/' + id,
                success: function(data) {
                    // Update wishlist afer remove product
                    wishlist();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }

                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })

        }
    </script>

    <script type="text/javascript">
        // Add product to Compare
        function addToCompare(product_id) {
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '/add-to-compare/' + product_id,
                success: function(data) {
                    // console.log(data);

                    // Update quantity comapre afer add product
                    compare();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>


    <script type="text/javascript">
        // Load data from  Compare
        function compare() {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/get-product-compare',
                success: function(data) {
                    // qty in view compare in compare page
                    var text = '';

                    text +=
                        `<span >Có <span style="color:#3BB77E; "> ${Object.keys(data).length}</span> sản phẩm trong so sánh của bạn </span>`;

                    $('#compare_qty').html(text);

                    // qty in icon compare in header
                    var infor = '';
                    infor += `${Object.keys(data).length}`
                    $('#qty_compare').html(infor);

                    var rows = '';

                    $.each(data, function(key, value) {

                        rows +=
                            `
                                <tr class="pr_image">
                                    <td class="text-muted font-sm fw-600 font-heading mw-200">Ảnh</td>
                                    <td class="row_img"><img src="/${value.product.product_thumbnail}" alt="compare-img" style="width:100%; height:300px; object-fit:fill;"/></td>
                                </tr>

                                <tr class="pr_title">
                                    <td class="text-muted font-sm fw-600 font-heading">Tên</td>
                                    <td class="product_name">
                                        <h6><a href="/product/details/${value.product.id}/${value.product.product_name.toLowerCase().trim().replace(/[^\w-]+/g, "-")}" class="text-heading">${value.product.product_name}</a></h6>
                                    </td>
                                    
                                </tr>
                                <tr class="pr_price">
                                    <td class="text-muted font-sm fw-600 font-heading">Giá</td>
                                    <td class="product_price">
                                        <h4 class="price text-brand">${Number(value.product.discount_price).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                    
                                </tr>
                            
                                <tr class="description">
                                    <td class="text-muted font-sm fw-600 font-heading">Miêu tả</td>
                                    <td class="row_text font-xs">
                                        <p class="font-sm text-muted">${value.product.long_description}</p>
                                    </td>
                                
                                </tr>
                                <tr class="pr_stock">
                                    <td class="text-muted font-sm fw-600 font-heading">Số lượng</td>

                                    ${value.product.product_qty > 0
                                    ?
                                        `
                                                                            <td class="row_stock"><span class="stock-status in-stock mb-0">Có sẵn</span></td>
                                                                            `    
                                    :
                                    `
                                                                        <td class="row_stock"><span class="stock-status out-stock mb-0">Hết hàng</span></td>
                                                                        `
                                    
                                    }
                                    
                                </tr>
                            
                            
                                <tr class="pr_remove text-muted">
                                    <td class="text-muted font-md fw-600"></td>
                                    <td class="row_remove">
                                        <a title="xóa" type="submit" class="text-muted" id="${value.id}" onclick="compareRemove(this.id)"><i class="fi-rs-trash mr-5" style="color:#f41127;" ></i><span style="color:#f41127;" >Xóa sản phẩm</span> </a>
                                    </td>
                                
                                </tr>

                            `
                    });

                    $('#compare').html(rows);
                }
            })
        }
        compare();


        // Remove product from compare
        function compareRemove(id) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/remove-product-compare/' + id,
                success: function(data) {
                    // Update comapre afer remove product
                    compare();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>

    <script type="text/javascript">
        // Show product on cart
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/get-product-cart',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.carts);
                    var cart_empty = '';
                    var cart = '';

                    if (Object.keys(data.carts).length === 0) {
                        $('#cart_empty').html(`
                            <h3 class="heading-2">Giỏ hàng trống</h3>
                            <a href="{{ url('/') }}" class="btn btn-success"><i class="fa-solid fa-arrow-right"></i> <span>Tiếp tục mua sắm</span> </a>
                        `);
                    } else {
                        $('#cart_empty').html(`<h3 class="heading-2">Giỏ hàng</h3>`)

                        $.each(data.carts, function(key, value) {
                            cart += `
                            <tr class="pt-30">
                                <td class="custome-checkbox pl-30">
                                
                                </td>
                                <td class="image product-thumbnail pt-40"><img src="/${value.options.image}" alt="#"></td>
                                <td class="product-des product-name">
                                    <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="/product/details/${value.id}/${value.name.toLowerCase().trim().replace(/[^\w-]+/g, "-")}">${value.name}</a></h6>
                                
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">${Number(value.price).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'} </h4>
                                </td>

                                <td class="price" data-title="Price">
                                    ${value.options.color == null
                                    ?
                                    `<span></span>`
                                    :
                                    `
                                                                        <h6 class="text-body">${value.options.color} </h6>
                                                                        `
                                    }
                                </td>

                                
                                <td class="price" data-title="Price">
                                    ${value.options.size == null
                                    ?
                                    `<span></span>`
                                    :
                                    `
                                                                        <h6 class="text-body">${value.options.size} </h6>
                                                                        `
                                    }
                                </td>

                                <td class="text-center detail-info" data-title="Stock">
                                    <div class="detail-extralink mr-15">
                                        <div class="detail-qty border radius">



                                            <a type="submit" class="qty-down"><i class="fi-rs-angle-small-down"  id="${value.rowId}" onclick="cartDecrementQty(this.id)"></i></a>



                                            <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">




                                            <a type="submit" class="qty-up"><i class="fi-rs-angle-small-up" id="${value.rowId}" onclick="cartIncrementQty(this.id)"></i></a>
                                        </div>
                                    </div>
                                </td>
                                <td class="price" data-title="Price">
                                    <h4 class="text-brand">${Number(value.subtotal).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'} </h4>
                                </td>
                                <td class="action text-center" data-title="Remove"><a type="submit" title="delete-product" id="${value.rowId}" onclick="cartRemove(this.id)" class="text-body"><i class="fi-rs-trash" style="color:#f41127;"></i></a></td>
                            </tr>
                            `
                        });
                    }

                    $('#cart').html(cart);
                }
            })
        }
        cart();

        // Remove product from Cart
        function cartRemove(rowId) {
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/remove-product-cart/' + rowId,
                success: function(data) {
                    // update price
                    calculateCoupon();


                    // Update cart afer remove product
                    cart();

                    // Update mini cart
                    miniCart();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })

        }

        //  Decrease quantity product
        function cartDecrementQty(rowId) {
            $.ajax({
                type: "GET",
                url: '/cart-decrement-quantity/' + rowId,
                dataType: 'json',
                success: function(data) {
                    // Update cart afer remove product
                    cart();

                    // Update mini cart
                    miniCart();

                    // update price
                    calculateCoupon();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }

            })

        }

        // Increase quantity product
        function cartIncrementQty(rowId) {
            $.ajax({
                type: "GET",
                url: '/cart-increase-quantity/' + rowId,
                dataType: 'json',
                success: function(data) {
                    // Update cart afer remove product
                    cart();

                    // Update mini cart
                    miniCart();

                    // update price
                    calculateCoupon();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })
        }
    </script>


    <script type="text/javascript">
        // Apply the Coupon
        function applyCoupon() {
            var coupon_name = $('#coupon_name').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {
                    coupon_name: coupon_name
                },
                url: '/apply-coupon',
                success: function(data) {
                    // update price
                    calculateCoupon();

                    // Apply the Coupon Successfully -> hide input field Apply Coupon
                    if (data.validity == true) {
                        $('#couponField').hide();
                    }

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }
            })

        }

        //Calculation Coupon
        function calculateCoupon() {
            $.ajax({

                type: 'GET',
                url: '/calculate-coupon',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.total);

                    // Do not apply the Coupon
                    if (data.total) {
                        $('#couponCalFiled').html(
                            `
                            <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền sản phẩm</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${Number(data.total).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                </tr>
                            
                            
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền thanh toán</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${Number(data.total).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                </tr>

                            `
                        );
                    }
                    // Apply coupon
                    else {
                        $('#couponCalFiled').html(
                            `
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền sản phẩm</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${Number(data.subtotal).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                </tr>
                            
                            
                            

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Mã Coupon</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">${data.coupon_name}
                                            <a type="submit" onclick="remveCoupon()">
                                                <i class="fa-regular fa-trash-can text-danger fs-6"></i>
                                            </a>
                                    </h6>
                                    </td>
                                </tr>


                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền giảm giá</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${Number(data.discount_amount).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                </tr>

                                <tr>
                                            <td scope="col" colspan="2">
                                                <div class="divider-2 mt-10 mb-10"></div>
                                            </td>
                                </tr>

                                
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Tổng tiền thanh toán</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${Number(data.total_amount).toLocaleString('vi-VN', { minimumFractionDigits: 0 })+'₫'}</h4>
                                    </td>
                                </tr>

                            `
                        );

                    }
                }
            })
        }
        calculateCoupon();
    </script>


    <script type="text/javascript">
        // Coupon Remove
        function remveCoupon() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/remove-coupon",

                success: function(data) {
                    // update price
                    calculateCoupon();

                    // Show input coupon after remove coupon
                    $('#couponField').show();

                    if (data.success) {
                        // Hiển thị thông báo thành công
                        toastr.success(data.message);
                    } else {
                        // Hiển thị thông báo lỗi
                        toastr.error(data.message);
                    }
                },
                error: function() {
                    // Hiển thị thông báo lỗi
                    toastr.error('Có lỗi xảy ra trong quá trình xử lý');
                }

            })
        }
    </script>
</body>

</html>
