@extends('admin.admin_dashboard')
@section('admin')
@section('title')
    Trang chủ
@endsection

@php
    $date = date('d F Y');
    $today_subtotal = App\Models\Order::where('order_date', $date)->sum('subtotal');
    $today_discount_coupon = App\Models\Order::where('order_date', $date)->sum('discount_coupon');
    $today_amount = $today_subtotal - $today_discount_coupon;
    $today_orders = App\Models\Order::where('order_date', $date)->get();
    
    $month = date('F');
    $month_subtotal = App\Models\Order::where('order_month', $month)->sum('subtotal');
    $month_discount_coupon = App\Models\Order::where('order_month', $month)->sum('discount_coupon');
    $month_amount = $month_subtotal - $month_discount_coupon;
    $month_orders = App\Models\Order::where('order_month', $month)->get();
    
    $year = date('Y');
    $year_subtotal = App\Models\Order::where('order_year', $year)->sum('subtotal');
    $year_discount_coupon = App\Models\Order::where('order_year', $year)->sum('discount_coupon');
    $year_amount = $year_subtotal - $year_discount_coupon;
    $year_orders = App\Models\Order::where('order_year', $year)->get();
    
    $total_discount_coupon = App\Models\Order::sum('discount_coupon');
    $total_subtotal = App\Models\Order::sum('subtotal');
    $total_amount = $total_subtotal - $total_discount_coupon;
    $total_orders = App\Models\Order::get();
    
    $orders_pending = App\Models\Order::where('status', 'pending')
        ->orderBy('created_at', 'DESC')
        ->get();
    
    $vendors_active = App\Models\User::where('status', 'active')
        ->where('role', 'vendor')
        ->get();
    $vendors_inactive = App\Models\User::where('status', 'inactive')
        ->where('role', 'vendor')
        ->get();
    
    $customers = App\Models\User::where('status', 'active')
        ->where('role', 'user')
        ->get();
    
@endphp

    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($today_subtotal, 0, '.', '.') }}₫</h5>
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
                            <p class="mb-0">Tổng tiền sản phẩm trong ngày {{ $today }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <h5 class="mb-0 ">{{ number_format($today_discount_coupon, 0, '.', '.') }}₫</h5>
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
                            <p class="mb-0">Tổng tiền giảm giá trong ngày {{ $today }}</p>
                        </div>
                    </div>
                </div>
            </div>


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

                            <h5 class="mb-0 ">{{ count($today_orders) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-truck-fast fs-3 "></i>
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
                            <p class="mb-0">Tổng đơn hàng trong ngày {{ $today }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($month_subtotal, 0, '.', '.') }}₫</h5>
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
                            <p class="mb-0">Tổng tiền sản phẩm trong tháng {{ $month }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($month_discount_coupon, 0, '.', '.') }}₫</h5>
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
                            <p class="mb-0">Tổng tiền giảm giá trong tháng {{ $month }}</p>
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
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <h5 class="mb-0 ">{{ count($month_orders) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-truck-fast fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            @php
                                $month = Carbon\Carbon::now()->format('m-Y');
                            @endphp
                            <p class="mb-0">Tổng đơn hàng trong tháng {{ $month }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($year_subtotal, 0, '.', '.') }}₫</h5>
                            <div class="ms-auto">
                                <i class="fa-regular fa-calendar fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            @php
                                $year = Carbon\Carbon::now()->format('Y');
                            @endphp
                            <p class="mb-0">Tổng tiền sản phẩm trong năm {{ $year }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($year_discount_coupon, 0, '.', '.') }}₫</h5>
                            <div class="ms-auto">
                                <i class="fa-regular fa-calendar fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            @php
                                $year = Carbon\Carbon::now()->format('Y');
                            @endphp
                            <p class="mb-0">Tổng tiền giảm giá trong năm {{ $year }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ number_format($year_amount, 0, '.', '.') }}₫</h5>
                            <div class="ms-auto">
                                <i class="fa-regular fa-calendar fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            @php
                                $year = Carbon\Carbon::now()->format('Y');
                            @endphp
                            <p class="mb-0">Tổng tiền thanh toán trong năm {{ $year }}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ count($year_orders) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-truck-fast fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            @php
                                $year = Carbon\Carbon::now()->format('Y');
                            @endphp
                            <p class="mb-0">Tổng đơn hàng trong năm {{ $year }}</p>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <h5 class="mb-0 ">{{ number_format($total_subtotal, 0, '.', '.') }}₫</h5>
                            <div class="ms-auto">
                                <i class="fa-regular fa-calendar fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <h5 class="mb-0 ">{{ number_format($total_discount_coupon, 0, '.', '.') }}₫</h5>
                            <div class="ms-auto">
                                <i class="fa-regular fa-calendar fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
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
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ count($total_orders) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-truck-fast fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="mb-0">Tổng đơn hàng</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ count($vendors_active) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-house-user fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="mb-0">Nhà cung cấp được hoạt động</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ count($vendors_inactive) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-house-user fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="mb-0">Nhà cung cấp không được hoạt động</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="mb-0 ">{{ count($customers) }}</h5>
                            <div class="ms-auto">
                                <i class="fa-solid fa-users fs-3 "></i>
                            </div>
                        </div>
                        <div class="progress my-3 bg-light-transparent" style="height:3px;">
                            <div class="progress-bar bg-dark" role="progressbar" style="width: 100%"
                                aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex align-items-center ">
                            <p class="mb-0">Người dùng</p>
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
                        <h5 class="mb-0">Danh sách đơn hàng đang chờ xử lý</h5>
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
                                <th>Tổng tiền sản phẩm</th>
                                <th>Tổng tiền giảm giá</th>
                                <th>Tổng tiền thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders_pending as $key => $order)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        {{ $order->invoice_no }}
                                    </td>
                                    <td> {{ $order['user']['name'] }}</td>
                                    <td> {{ date('j-n-Y', strtotime($order->order_date)) }}</td>
                                    <td> {{ $order->payment_method }}</td>
                                    <td>{{ number_format($order->subtotal, 0, '.', '.') }}₫</td>
                                    <td>{{ number_format($order->discount_coupon, 0, '.', '.') }}₫</td>
                                    <td>{{ number_format($order->amount, 0, '.', '.') }}₫</td>
                                    <td> <span class="badge rounded-pill bg-warning">chờ xử lý</span></td>
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
                                <th>Tổng tiền sản phẩm</th>
                                <th>Tổng tiền giảm giá</th>
                                <th>Tổng tiền thanh toán</th>
                                <th>Trạng thái đơn hàng</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
