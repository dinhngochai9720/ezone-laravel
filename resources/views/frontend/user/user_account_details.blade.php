@extends('frontend.user.body.dashboard')
@section('user')
@section('title')
    Thông tin tài khoản
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> Thông tin tài khoản
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
                                        <h5>Thông tin tài khoản</h5>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('user.update.profile') }}"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="old_image" value="{{ $userData->photo }}" />

                                            <div class="row">
                                                <div class="form-group col-md-12">
                                                    <label>Email<span class="required">*</span></label>
                                                    <input required="" class="form-control" name="email"
                                                        type="email" value="{{ $userData->email }}" disabled />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Tên <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name"
                                                        type="text" value="{{ $userData->name }}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Họ tên <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="fullname"
                                                        type="text" value="{{ $userData->fullname }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Điện thoại<span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone"
                                                        type="text" value="{{ $userData->phone }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Địa chỉ<span class="required">*</span></label>
                                                    <input required="" class="form-control" name="address"
                                                        type="text" value="{{ $userData->address }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Ảnh<span class="required">*</span></label>
                                                    <input id="image" class="form-control" name="photo"
                                                        type="file" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <img id="showImage"
                                                        src="{{ !empty($userData->photo) ? url($userData->photo) : url('upload/no_image.jpg') }}"
                                                        alt="User" style="width: 100px ; height: 100px;"
                                                        class="rounded-circle">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit"
                                                        class="btn btn-fill-out submit font-weight-bold" name="submit"
                                                        value="Submit">Cập nhật</button>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection
