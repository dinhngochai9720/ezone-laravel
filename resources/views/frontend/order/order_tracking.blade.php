@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Theo dõi đơn hàng
@endsection

<style type="text/css">
    .card {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.1rem;
    }

    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0;
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px;
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative;
    }

    .track .step.active:before {
        background: #3bb77e;
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px;
    }

    .track .step.active .icon {
        background: #3bb77e;
        color: #fff;
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd;
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000;
    }

    .track .text {
        display: block;
        margin-top: 7px;
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%;
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0;
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px;
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0;
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px;
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
</style>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Theo dõi đơn hàng
        </div>
    </div>
</div>


<div class="container">
    <article class="card">
        <div class="card-body">
            <h6>Mã hóa đơn: #{{ $order_tracking->invoice_no }}</h6>
            <article class="card">

                <div class="card-body row">
                    <div class="col"> <strong>Ngày đặt hàng:</strong> <br>
                        {{ date('j-n-Y', strtotime($order_tracking->order_date)) }} </div>
                    <div class="col"> <strong>Khách hàng:</strong> <br> {{ $order_tracking['user']['fullname'] }} |
                        <i class="fa fa-phone"></i> {{ $order_tracking->phone }} </div>
                    <div class="col"> <strong>Phương thức thanh toán:</strong> <br>
                        {{ $order_tracking->payment_method }} </div>
                    <div class="col"> <strong>Tổng tiền thanh toán:</strong> <br>
                        {{ number_format($order_tracking->amount, 0, '.', '.') }}₫ </div>
                </div>
            </article>
            <div class="track">

                @if ($order_tracking->status == 'pending')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Chờ xử lý</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">Đã xác nhận</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">
                            Đang xử lý </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Đã giao hàng</span> </div>
                @elseif ($order_tracking->status == 'confirmed')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Chờ xử lý</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">Đã xác nhận</span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text">
                            Đang xử lý </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Đã giao hàng</span> </div>
                @elseif ($order_tracking->status == 'processing')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Chờ xử lý</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">Đã xác nhận</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text"> Đang xử lý </span> </div>
                    <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Đã giao hàng</span> </div>
                @elseif ($order_tracking->status == 'delivered')
                    <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span
                            class="text">Chờ xử lý</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span
                            class="text">Đã xác nhận</span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span
                            class="text"> Đang xử lý </span> </div>
                    <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span
                            class="text">Đã giao hàng</span> </div>
                @endif
            </div>
            <hr>

            <hr>
            <a href="{{ route('user.orders.page') }}" class="btn" data-abc="true"> <i
                    class="fa fa-chevron-left"></i>Quay lại</a>
        </div>
    </article>
</div>
@endsection
