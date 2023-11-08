@extends('frontend.user.body.dashboard')
@section('user')
@section('title')
    Đơn hàng hoàn lại
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span>Đơn hàng hoàn lại
        </div>
    </div>
</div>

<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('frontend.body.dashboard_sidebar_menu')
                    {{-- End col-md-3 --}}

                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Danh sách đơn hàng hoàn lại</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Mã hóa đơn</th>
                                                        <th>Ngày đặt hàng</th>
                                                        <th>Tổng tiền sản phẩm</th>
                                                        <th>Tổng tiền thanh toán</th>
                                                        <th>Phương thức</th>
                                                        <th>Lý do</th>
                                                        <th>Trạng thái</th>
                                                        <th>Xem/xuất</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $key => $order)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $order->invoice_no }}</td>
                                                            <td>{{ date('j-n-Y', strtotime($order->order_date)) }}</td>
                                                            <td>{{ number_format($order->subtotal, 0, '.', '.') }}₫</td>
                                                            <td>{{ number_format($order->amount, 0, '.', '.') }}₫</td>
                                                            <td>{{ $order->payment_method }}</td>
                                                            <td>{{ $order->return_reason }}</td>
                                                            <td>

                                                                @if ($order->return_order == 0)
                                                                    <span class="badge rounded-pill bg-danger">thất
                                                                        bại</span>
                                                                @elseif($order->return_order == 1)
                                                                    <span class="badge rounded-pill bg-primary">đang xử
                                                                        lý</span>
                                                                @elseif($order->return_order == 2)
                                                                    <span class="badge rounded-pill bg-success">thành
                                                                        công</span>
                                                                @endif

                                                            </td>
                                                            <td class="d-flex justify-content-evenly">
                                                                <a title="view-order-details"
                                                                    href="{{ url('user/order-details/' . $order->id) }}"
                                                                    class="btn-small d-block">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </a>
                                                                <a title="download-invoice"
                                                                    href="{{ url('user/invoice-download/' . $order->id) }}"
                                                                    class="btn-small d-block">
                                                                    <i class="fa-solid fa-download"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End col-md-9 --}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
