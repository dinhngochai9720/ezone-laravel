@extends('frontend.master_dashboard')
@section('title')
    Không tìm thấy trang
@endsection

@section('main')
    <div class="page-content pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto text-center">
                    <p class="mb-20"><img src="{{ asset('frontend/assets/imgs/page/page-404.png') }}" alt=""
                            class="hover-up" /></p>
                    <h1 class="display-2 mb-30">Không tìm thấy trang</h1>


                    <a class="btn btn-default submit-auto-width font-xs hover-up mt-30" href="{{ url('/') }}"><i
                            class="fi-rs-home mr-5"></i> Quay lại trang chủ</a>
                </div>
            </div>
        </div>
    </div>
@endsection
