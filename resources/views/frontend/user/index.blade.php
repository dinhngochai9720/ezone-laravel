@extends('frontend.user.body.dashboard')
@section('user')
@section('title')
    Tài khoản
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Tài khoản
        </div>
    </div>
</div>

<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">
                    @include('frontend.body.dashboard_sidebar_menu')

                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Xin chào {{ Auth::user()->name }}</h3>
                                        <br />
                                        <img id="showImage"
                                            src="
                                                        {{ !empty($userData->photo) ? url($userData->photo) : url('upload/no_image.jpg') }}
                                                        "
                                            alt="user-image" style="width: 100px ; height: 100px;"
                                            class="rounded-circle">
                                    </div>
                                    <div class="card-body">
                                        <p>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
