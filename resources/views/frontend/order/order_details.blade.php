@extends('frontend.user.body.dashboard')

@section('user')

@section('title')
    Chi tiết đơn hàng
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Chi tiết đơn hàng
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
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Chi tiết vận chuyển </h4>
                                    </div>
                                    <hr />
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>Khách hàng:</th>
                                                <th class="text-dark fs-6 fw-bold">{{ $order->name }}</th>
                                            </tr>
                                            <tr>
                                                <th>Điện thoại:</th>
                                                <th class="text-dark fs-6 fw-bold">{{ $order->phone }}</th>
                                            </tr>

                                            {{-- <tr>
                                                        <th>Email:</th>
                                                        <th class="text-dark fs-6 fw-bold">{{$order->email}}</th>
                                                    </tr> --}}
                                            <tr>
                                                <th>Đường/phường/xã:</th>
                                                <th class="text-dark fs-6 fw-bold">{{ $order['state']['state_name'] }}
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Quận/huyện:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ $order['district']['district_name'] }}</th>
                                            </tr>
                                            <tr>
                                                <th>Thành phố/tỉnh:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ $order['division']['division_name'] }}</th>
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
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ date('j-n-Y', strtotime($order->order_date)) }}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
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
                                                <th>Phương thức thanh toán:</th>
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
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ date('j-n-Y', strtotime($order->order_date)) }}</th>
                                            </tr>


                                            <tr>
                                                <th>Tổng tiền sản phẩm:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ number_format($order->subtotal, 0, '.', '.') }}₫</th>
                                            </tr>

                                            <tr>
                                                <th>Tổng tiền giảm giá:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ number_format($order->discount_coupon, 0, '.', '.') }}₫</th>
                                            </tr>


                                            <tr>
                                                <th>Tổng tiền thanh toán:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ number_format($order->amount, 0, '.', '.') }}₫</th>
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
                                                        <span class="badge rounded-pill bg-success">đã giao
                                                            hàng</span>
                                                    @endif

                                                </th>
                                            </tr>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <h4 class="card-header">Chi tiết sản phẩm</h4>
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="col-md-1">
                                                    <label class="text-dark fs-6 fw-bold">Ảnh</label>
                                                </td>
                                                <td class="col-md-3">
                                                    <label class="text-dark fs-6 fw-bold">Tên </label>
                                                </td>
                                                <td class="col-md-2">
                                                    <label class="text-dark fs-6 fw-bold">Nhà cung cấp</label>
                                                </td>
                                                <td class="col-md-1">
                                                    <label class="text-dark fs-6 fw-bold">Code </label>
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
                                                <td class="col-md-2">
                                                    <label class="text-dark fs-6 fw-bold">Giá</label>
                                                </td>
                                            </tr>

                                            @foreach ($order_items as $item)
                                                <tr>
                                                    <td class="col-md-1">
                                                        <label><img
                                                                style="width: 100%; object-fit: fill; border-radius: 10px"
                                                                src="{{ asset($item['product']['product_thumbnail']) }}" /></label>
                                                    </td>
                                                    <td class="col-md-3">
                                                        <label>{{ $item['product']['product_name'] }}</label>
                                                    </td>

                                                    <td class="col-md-2">
                                                        @if ($item->vendor_id == null)
                                                            <label>Admin</label>
                                                        @else
                                                            <label>{{ $item['product']['vendor']['name'] }}</label>
                                                        @endif

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
                                                    <td class="col-md-2">
                                                        <label>{{ number_format($item->price, 0, '.', '.') }}₫ x
                                                            {{ $item->qty }} =
                                                            {{ number_format($item->price * $item->qty, 0, '.', '.') }}₫</label>
                                                    </td>

                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th>Tổng tiền sản phẩm:</th>
                                                <th class="text-dark fs-6 fw-bold">
                                                    {{ number_format($order->subtotal, 0, '.', '.') }}₫</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        {{-- Start return order option --}}
                        @if ($order->status !== 'delivered')
                            {{-- Not delivered -> empty --}}
                        @else
                            @php
                                $order = App\Models\Order::where('id', $order->id)
                                    ->where('return_reason', '=', null)
                                    ->first();
                            @endphp
                            {{-- Do not send return request --}}
                            @if ($order)
                                {{-- Delivered --}}
                                <form action="{{ route('user.return.order', $order->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <h4 class="card-header mb-1">Lý do hoàn lại đơn hàng</h4>
                                        <textarea rows="3" name="return_reason" class="form-control" placeholder="Nhập lý do hoàn lại đơn hàng"></textarea>
                                    </div>
                                    <button type="submit" class="">Xác nhận</button>
                                </form>

                                {{-- Send request --}}
                            @else
                                <h5><span class="badge rounded-pill bg-success">Bạn đã gửi yêu cầu trả lại cho đơn đặt
                                        hàng này thành công</span></h5>
                            @endif
                        @endif
                        {{-- End return order option --}}
                    </div>
                    {{-- End col-md-9 --}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
