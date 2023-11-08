@extends('frontend.user.body.dashboard')

@section('user')
@section('title')
    Theo dõi đơn hàng
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Theo dõi đơn hàng
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
                                        <h5>Theo dõi đơn hàng</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('user.check.tracking.order') }}">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Mã hóa đơn<span class="required">*</span></label>
                                                    <input type="text" name="invoice_code" class="form-control"
                                                        placeholder="Nhập mã hóa đơn" required />
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold" name="submit"
                                                        value="Submit">Gửi</button>
                                                </div>
                                            </div>
                                        </form>
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
