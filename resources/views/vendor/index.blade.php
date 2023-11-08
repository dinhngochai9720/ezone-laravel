@extends('vendor.vendor_dashboard')
@section('vendor')
@section('title')
    Trang chủ
@endsection


@php
    $id = Auth::user()->id;
    $vendorId = App\Models\User::find($id);
    $status = $vendorId->status;
    
    $order_items = App\Models\OrderItem::where('vendor_id', $id)
        ->orderBy('created_at', 'DESC')
        ->get();
    
    // order_items duplicate -> get only 1 order_item if duplicate
    $order_items_unique = $order_items->unique(['order_id']);
    $order_item_duplicates = $order_items->diff($order_items_unique);
    
    // https://laravel.com/docs/8.x/collections#method-diff
    $collection = $order_items;
    $diff_order_items = $collection->diff($order_item_duplicates);
    $diff_order_items->all();
    // dd($diff_order_items);
    
    $today = date('d F Y');
    $month = date('F');
    $year = date('Y');
    
    $today_amount = 0;
    $month_amount = 0;
    $year_amount = 0;
    
    $total_discount_coupon = 0;
    $total_subtotal = 0;
    
    $amount_no_discount_year = 0;
    $amount_discount_year = 0;
    
    $amount_no_discount_month = 0;
    $amount_discount_month = 0;
    
    $amount_no_discount_today = 0;
    $amount_discount_today = 0;
    
    foreach ($order_items as $key => $item) {
        $coupon = round(($item['order']['discount_coupon'] / $item['order']['subtotal']) * 100);
        $discount_coupon = round(($coupon / 100) * $item->price * $item->qty);
        // amount have the coupon
        $amount = round($item->price * $item->qty - $discount_coupon);
    
        if ($item['order']['discount_coupon'] > 0) {
            $total_discount_coupon += $discount_coupon;
        }
        // total_subtotal
        $total_subtotal += $item->price * $item->qty;
    
        if ($item['order']['order_year'] == $year) {
            if ($item['order']['discount_coupon'] == 0) {
                $amount_no_discount_year += $item->price * $item->qty;
            }
            if ($item['order']['discount_coupon'] > 0) {
                $amount_discount_year += $amount;
            }
        }
    
        if ($item['order']['order_month'] == $month) {
            if ($item['order']['discount_coupon'] == 0) {
                $amount_no_discount_month += $item->price * $item->qty;
            }
            if ($item['order']['discount_coupon'] > 0) {
                $amount_discount_month += $amount;
            }
        }
    
        if ($item['order']['order_date'] == $today) {
            if ($item['order']['discount_coupon'] == 0) {
                $amount_no_discount_today += $item->price * $item->qty;
            }
            if ($item['order']['discount_coupon'] > 0) {
                $amount_discount_today += $amount;
            }
        }
    }
    $month_amount = $amount_no_discount_month + $amount_discount_month;
    $year_amount = $amount_no_discount_year + $amount_discount_year;
    $today_amount = $amount_no_discount_today + $amount_discount_today;
    
    $total_amount = $total_subtotal - $total_discount_coupon;
    
@endphp

<div class="page-content">

    @if ($status === 'active')
        <h4 class="fs-5">Tài khoản được phép <span class="text-success fs-5"><b>hoạt động</b></span></h4>
    @else
        <h4>Tài khoản chưa được phép <span class="text-danger fs-5"><b>hoạt động</b></span></h4>
        <p class="text-danger fs-5">Vui lòng chờ <b>Quản trị viên</b> phê duyệt hoạt động</p>
    @endif

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($today_amount, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $today = Carbon\Carbon::now()->format('d-m-Y');
                        @endphp
                        <p class="mb-0">Tổng tiền thanh toán trong ngày {{ $today }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($month_amount, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $month = Carbon\Carbon::now()->format('m-Y');
                        @endphp
                        <p class="mb-0">Tổng tiền thanh toán trong tháng {{ $month }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($year_amount, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $year = Carbon\Carbon::now()->format('Y');
                        @endphp
                        <p class="mb-0">Tổng tiền thanh toán năm {{ $year }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
        </div>


        <div class="col">
            <div class="card radius-10 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($total_subtotal, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $today = Carbon\Carbon::now()->format('d-m-Y');
                        @endphp
                        <p class="mb-0">Tổng tiền sản phẩm</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="col">
            <div class="card radius-10  ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($total_discount_coupon, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $today = Carbon\Carbon::now()->format('d-m-Y');
                        @endphp
                        <p class="mb-0">Tổng tiền giảm giá</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ number_format($total_amount, 0, '.', '.') }}₫</h5>
                        <div class="ms-auto">
                            <i class="fa-regular fa-calendar fs-3 "></i>
                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        @php
                            $year = Carbon\Carbon::now()->format('Y');
                        @endphp
                        <p class="mb-0">Tổng tiền thanh toán</p>
                    </div>
                </div>
            </div>
        </div>



        <div class="col">
            <div class="card radius-10 ">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <h5 class="mb-0 ">{{ count($diff_order_items) }}</h5>
                        <div class="ms-auto">
                            <i class="fa-solid fa-truck-fast fs-3 "></i>

                        </div>
                    </div>
                    <div class="progress my-3 bg-light-transparent" style="height:3px;">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: 100%" aria-valuenow="25"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="d-flex align-items-center ">
                        <p class="mb-0">Tổng đơn hàng</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--end row-->



    <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Tất cả đơn hàng</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="width:100%" id="example">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Mã hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($diff_order_items as $key => $order_item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    {{ $order_item['order']['invoice_no'] }}
                                </td>
                                <td> {{ $order_item['order']['user']['name'] }}</td>

                                <td> {{ date('j-n-Y', strtotime($order_item['order']['order_date'])) }}</td>
                                <td> {{ $order_item['order']['payment_method'] }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>


                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Hóa đơn</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái đơn hàng</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
