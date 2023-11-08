@extends('vendor.vendor_dashboard')

@section('vendor')
@section('title')
    Chi tiết đơn hàng
@endsection


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Đơn hàng</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i
                                class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">


            <a href="{{ route('vendor.all.order') }}" class="btn btn-primary"><i
                    class="fa-solid fa-circle-arrow-left"></i><span>Quay lại</span></a>

        </div>
    </div>
    <!--end breadcrumb-->
    <hr />


    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết vận chuyển</h4>
                </div>
                <hr />
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Khách hàng:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->name }}</th>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->phone }}</th>
                        </tr>

                        <tr>
                            <th>Đường/phường/xã:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order['state']['state_name'] }}</th>
                        </tr>
                        <tr>
                            <th>Quận/huyện:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order['district']['district_name'] }}</th>
                        </tr>
                        <tr>
                            <th>Thành phố/tỉnh:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order['division']['division_name'] }}</th>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->address }}</th>
                        </tr>
                        <tr>
                            <th>Post Code:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->post_code }}</th>
                        </tr>
                        <tr>
                            <th>Ngày đặt hàng:</th>
                            <th class="text-dark fs-6 fw-bold">{{ date('j-n-Y', strtotime($order->order_date)) }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Chi tiết đơn hàng
                        <span class="text-primary">#{{ $order->invoice_no }}</span>
                    </h4>
                </div>
                <hr />
                <div class="card-body">
                    <table class="table">

                        <tr>
                            <th>Khách hàng:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->name }}</th>
                        </tr>

                        <tr>
                            <th>Số điện thoại:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->phone }}</th>
                        </tr>



                        <tr>
                            <th>Địa chỉ:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->address }}</th>
                        </tr>


                        <tr>
                            <th> Phương thức thanh toán:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->payment_method }}</th>
                        </tr>

                        <tr>
                            <th>Mã số giao dịch:</th>
                            <th class="text-dark fs-6 fw-bold">{{ $order->transaction_id }}</th>
                        </tr>

                        <tr>
                            <th>Mã hóa đơn:</th>
                            <th class="text-dark fs-6 fw-bold">#{{ $order->invoice_no }}</th>
                        </tr>

                        <tr>
                            <th>Ngày đặt hàng:</th>
                            <th class="text-dark fs-6 fw-bold">{{ date('j-n-Y', strtotime($order->order_date)) }}</th>
                        </tr>

                        <tr>
                            <th>Trạng thái đơn hàng:</th>
                            <th>
                                @if ($order->status == 'pending')
                                    <span class="badge rounded-pill bg-warning">chờ xử lý</span>
                                @elseif($order->status == 'confirmed')
                                    <span class="badge rounded-pill bg-info">đã xác nhận</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge rounded-pill bg-primary">đang xử lý</span>
                                @elseif($order->status == 'delivered')
                                    <span class="badge rounded-pill bg-success">đã giao hàng</span>
                                @endif
                            </th>
                        </tr>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
        <div class="col">
            <div class="card">
                <div class="table-responsive">
                    <h4 class="card-header">Chi tiết sản phẩm</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td class="col-md-1">
                                    <label class="text-dark fs-6 fw-bold">Ảnh</label>
                                </td>
                                <td class="col-md-4">
                                    <label class="text-dark fs-6 fw-bold">Tên</label>
                                </td>

                                <td class="col-md-1">
                                    <label class="text-dark fs-6 fw-bold">Code</label>
                                </td>
                                <td class="col-md-1">
                                    <label class="text-dark fs-6 fw-bold">Màu</label>
                                </td>
                                <td class="col-md-1">
                                    <label class="text-dark fs-6 fw-bold">Size</label>
                                </td>
                                <td class="col-md-1">
                                    <label class="text-dark fs-6 fw-bold">Số lượng</label>
                                </td>
                                <td class="col-md-3">
                                    <label class="text-dark fs-6 fw-bold">Giá</label>
                                </td>

                            </tr>

                            @foreach ($order_items as $item)
                                <tr>
                                    <td class="col-md-1">
                                        <label><img style="width: 100%; object-fit: fill; border-radius: 10px"
                                                src="{{ asset($item['product']['product_thumbnail']) }}" /></label>
                                    </td>
                                    <td class="col-md-4">
                                        <label>{{ $item['product']['product_name'] }}</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label>{{ $item['product']['product_code'] }}</label>
                                    </td>
                                    <td class="col-md-1">
                                        @if ($item->color == null)
                                            <label></label>
                                        @else
                                            <label>{{ $item->color }}</label>
                                        @endif

                                    </td>
                                    <td class="col-md-1">
                                        @if ($item->size == null)
                                            <label></label>
                                        @else
                                            <label>{{ $item->size }}</label>
                                        @endif
                                    </td>
                                    <td class="col-md-1">
                                        <label>{{ $item->qty }}</label>
                                    </td>
                                    <td class="col-md-3">
                                        <label>{{ number_format($item->price, 0, '.', '.') }}₫ x {{ $item->qty }} =
                                            {{ number_format($item->price * $item->qty, 0, '.', '.') }}₫</label>
                                    </td>

                                </tr>
                            @endforeach

                            @php
                                
                                $subtotal = 0;
                                foreach ($order_items as $key => $item) {
                                    $subtotal += $item->price * $item->qty;
                                }
                                
                                $coupon = round(($order->discount_coupon / $order->subtotal) * 100);
                                $discount_coupon = round(($coupon / 100) * $subtotal);
                                $gran_total = round($subtotal - ($coupon / 100) * $subtotal);
                                
                            @endphp

                            <tr>
                                <th>Tổng tiền sản phẩm:</th>
                                <th class="text-dark fs-6 fw-bold">{{ number_format($subtotal, 0, '.', '.') }}₫</th>
                            </tr>

                            <tr>
                                <th>Tổng tiền giảm giá:</th>
                                <th class="text-dark fs-6 fw-bold"> {{ number_format($discount_coupon, 0, '.', '.') }}₫
                                </th>
                            </tr>

                            <tr>
                                <th>Tổng tiền thanh toán:</th>
                                <th class="text-dark fs-6 fw-bold"> {{ number_format($gran_total, 0, '.', '.') }}₫</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

</div>
@endsection
