@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách đơn hàng đã xác nhận
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Đơn hàng</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng đã xác nhận</li>
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


    <h6>Tổng đơn hàng: <span class="">{{ count($orders) }}</span></h6>
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
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Tổng tiền sản phẩm</th>
                            <th>Tổng tiền giảm giá</th>
                            <th>Tổng tiền thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $order->invoice_no }} </td>
                                <td>{{ $order->name }} </td>
                                <td>{{ $order->phone }} </td>
                                <td>{{ $order->address }} </td>
                                <td>{{ date('j-n-Y', strtotime($order->order_date)) }}</td>
                                <td>{{ $order->payment_method }} </td>
                                <td>{{ number_format($order->subtotal, 0, '.', '.') }}₫</td>
                                <td>{{ number_format($order->discount_coupon, 0, '.', '.') }}₫</td>
                                <td>{{ number_format($order->amount, 0, '.', '.') }}₫</td>

                                <td>
                                    <span class="badge rounded-pill bg-info">đã xác nhận</span>
                                </td>

                                <td>
                                    <a href="{{ route('admin.order.details', $order->id) }}" class="me-2"
                                        title="xem đơn hàng"><i class="fa-regular fa-eye text-primary fs-6"></i></a>

                                    {{-- <a href="{{route('admin.invoice.download',$order->id)}}" class="me-2" title="xuất đơn hàng"><i class="fa-solid fa-download text-dark fs-6"></i></a> --}}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Tổng tiền sản phẩm</th>
                            <th>Tổng tiền giảm giá</th>
                            <th>Tổng tiền thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                            <th>Xem</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
