@extends('frontend.master_dashboard')
@section('main')
@section('title')
    So sánh sản phẩm
@endsection


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> So sánh sản phẩm
        </div>
    </div>
</div>
<div class="container mb-80 mt-50">
    <div class="row">
        <div class="col-xl-10 col-lg-12 m-auto">
            <h1 class="heading-2 mb-10">So sánh sản phẩm</h1>
            <h6 class="text-body mb-40" id="compare_qty"></h6>
            <div class="table-responsive">
                <table class="table text-center table-compare">
                    <tbody id="compare">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
