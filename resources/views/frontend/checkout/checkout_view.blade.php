@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Thanh toán
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Thanh toán
        </div>
    </div>
</div>

<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-lg-12 mb-40 d-flex align-items-center justify-content-between">
            <h3 class="heading-2 mb-10">Thanh toán</h3>

            <a href="{{ route('cart') }}" class="btn btn-success"> Quay lại giỏ hàng</a>
        </div>
    </div>

    <form id="myForm" method="POST" action="{{ route('store.checkout') }}">
        @csrf

        <div class="row">
            <div class="col-lg-7">
                <div class="row">
                    <h4 class="mb-30">Chi tiết thanh toán</h4>



                    <div class="row">
                        <div class="form-group col-lg-6">
                            <input type="text" name="shipping_name" value="{{ Auth::user()->name }}"
                                placeholder="Họ tên *">
                        </div>
                        <div class="form-group col-lg-6">
                            <input type="email" name="shipping_email" value="{{ Auth::user()->email }}"
                                placeholder="Email *">
                        </div>
                    </div>


                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select name="division_id" class="form-control select-active">
                                    <option value="">Chọn thành phố/tỉnh</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <input type="text" name="shipping_phone" value="{{ Auth::user()->phone }}"
                                placeholder="Điện thoại *">
                        </div>
                    </div>

                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select name="district_id" class="form-control select-active">
                                    <option value="">Chọn quận/huyện</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <input type="number" name="post_code" placeholder="Post Code *">
                        </div>
                    </div>


                    <div class="row shipping_calculator">
                        <div class="form-group col-lg-6">
                            <div class="custom_select">
                                <select name="state_id" class="form-control select-active">

                                    <option value="">Chọn đường/xã/phường</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-lg-6">
                            <input type="text" name="shipping_address" value="{{ Auth::user()->address }}"
                                placeholder="Địa chỉ *">
                        </div>
                    </div>

                    <div class="form-group mb-30">
                        <textarea rows="5" placeholder="Ghi chú" name="notes"></textarea>
                    </div>
                </div>
            </div>


            <div class="col-lg-5">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Đơn hàng</h4>

                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">
                        <table class="table no-border">
                            <tbody>
                                @foreach ($carts as $item)
                                    <tr>
                                        <td class="image product-thumbnail"><img
                                                src="{{ asset($item->options->image) }}" alt="#"></td>
                                        <td>
                                            <h6 class="w-160 mb-5"><a
                                                    href='/product/details/{{ $item->id }}/{{ strtolower(str_replace(' ', '-', $item->name)) }}'
                                                    class="text-heading">{{ $item->name }}</a></h6>
                                            <div class="">

                                                <p>Màu : {{ $item->options->color }}</p>
                                                <p>Size : {{ $item->options->size }}</p>

                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="text-muted">x {{ $item->qty }}</h6>
                                        </td>
                                        <td>
                                            <h4 class="text-brand"> {{ number_format($item->price, 0, '.', '.') }}₫
                                            </h4>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <table class="table no-border">
                            <tbody>
                                @if (Session::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Tổng tiền sản phẩm</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{ number_format($cart_total, 0, '.', '.') }}₫
                                            </h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Mã Coupon</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">
                                                {{ session()->get('coupon')['coupon_name'] }}
                                                ({{ session()->get('coupon')['coupon_discount'] }}%)</h6>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Tổng tiền giảm giá</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{ number_format(session()->get('coupon')['discount_amount'], 0, '.', '.') }}₫
                                            </h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Tổng tiền thanh toán</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{ number_format(session()->get('coupon')['total_amount'], 0, '.', '.') }}₫
                                            </h4>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Tổng tiền thanh toán</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{ number_format($cart_total, 0, '.', '.') }}₫
                                            </h4>
                                        </td>
                                    </tr>
                                @endif



                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="payment ml-30">
                    <h4 class="mb-30">Phương thức thanh toán</h4>
                    <div class="payment_option">
                        <div class="custome-radio">
                            <input value="cash" class="form-check-input" required="" type="radio"
                                name="payment_option" id="exampleRadios4" checked="">
                            <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                data-target="#checkPayment" aria-controls="checkPayment">Thanh toán khi nhận
                                hàng</label>
                        </div>
                    </div>
                    <div class="payment-logo d-flex">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-paypal.svg') }}"
                            alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-visa.svg') }}"
                            alt="">
                        <img class="mr-15" src="{{ asset('frontend/assets/imgs/theme/icons/payment-master.svg') }}"
                            alt="">
                        <img src="{{ asset('frontend/assets/imgs/theme/icons/payment-zapper.svg') }}" alt="">
                    </div>

                    <button type="submit" class="btn btn-fill-out btn-block mt-30">Đặt hàng<i
                            class="fi-rs-sign-out ml-15"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">
    // Show district
    $(document).ready(function() {
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/get-district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        // console.log(data);

                        $('select[name="state_id"]').html('');
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('Đã xảy ra lỗi! Vui lòng thử lại');
            }
        });
    });


    // Show state
    $(document).ready(function() {
        $('select[name="district_id"]').on('change', function() {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/get-state/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {

                        // console.log(data);

                        $('select[name="state_id"]').html('');

                        var d = $('select[name="state_id"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' +
                                value.id + '">' + value.state_name + '</option>'
                            );
                        });
                    },
                });
            } else {
                alert('Đã xảy ra lỗi! Vui lòng thử lại');
            }
        });
    });
</script>

{{-- Validate --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                shipping_name: {
                    required: true,
                },
                shipping_email: {
                    required: true,
                },

                division_id: {
                    required: true,
                },

                shipping_phone: {
                    required: true,
                },
                district_id: {
                    required: true,
                },

                post_code: {
                    required: true,
                },

                state_id: {
                    required: true,
                },

                shipping_address: {
                    required: true,
                },
            },
            messages: {
                shipping_name: {
                    required: 'Chưa nhập họ tên!',
                },
                shipping_email: {
                    required: 'Chưa nhập email!',
                },
                division_id: {
                    required: 'Chưa chọn thành phố/tỉnh!',
                },
                shipping_phone: {
                    required: 'Chưa nhập số điện thoại!',
                },
                district_id: {
                    required: 'Chưa chọn quận/huyện!',
                },
                post_code: {
                    required: 'Chưa nhập Post Code!',
                },
                state_id: {
                    required: 'Chưa chọn đường/xã/phường!',
                },

                shipping_address: {
                    required: 'Chưa nhập địa chỉ!',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection
