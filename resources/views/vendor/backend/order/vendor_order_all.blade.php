@extends('vendor.vendor_dashboard')

@section('vendor')
@section('title')
    Danh sách đơn hàng
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />


    @php
        $count = 0;
        foreach ($diff_order_items as $key => $order_item) {
            $count++;
        }
    @endphp



    <h6>Tổng đơn hàng: <span class="">{{ $count }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($diff_order_items as $key => $order_item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order_item['order']['invoice_no'] }} </td>
                                <td>{{ $order_item['order']['name'] }} </td>
                                <td>{{ $order_item['order']['phone'] }} </td>
                                <td>{{ $order_item['order']['address'] }} </td>
                                <td> {{ date('j-n-Y', strtotime($order_item['order']['order_date'])) }}</td>
                                <td>{{ $order_item['order']['payment_method'] }} </td>

                                <td>

                                    @if ($order_item['order']['status'] == 'pending')
                                        <span class="badge rounded-pill bg-warning">chờ xử lý</span>
                                    @elseif($order_item['order']['status'] == 'confirmed')
                                        <span class="badge rounded-pill bg-info">đã xác nhận</span>
                                    @elseif($order_item['order']['status'] == 'processing')
                                        <span class="badge rounded-pill bg-primary">đang xử lý</span>
                                    @elseif($order_item['order']['status'] == 'delivered')
                                        <span class="badge rounded-pill bg-success">đã giao hàng</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('vendor.order-details', $order_item['order']['id']) }}"
                                        class="me-2" title="xem đơn hàng"><i
                                            class="fa-regular fa-eye text-primary fs-6"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Xem</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
