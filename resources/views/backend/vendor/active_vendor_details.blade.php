@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Chi tiết nhà cung cấp được phép hoạt động
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Nhà cung cấp</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Chi tiết nhà cung cấp được phép hoạt
                        động</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('active.vendor') }}" class="btn btn-primary"><i
                    class="fa-solid fa-circle-arrow-left"></i><span>Quay lại</span></a>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('inactive.vendor.approve') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $activeVendorDetails->id }}" />
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control"
                                            value="{{ $activeVendorDetails->email }}" disabled />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Shop</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $activeVendorDetails->name }}" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Họ tên</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="fullname" class="form-control"
                                            value="{{ $activeVendorDetails->fullname }}" disabled />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Điện thoại</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $activeVendorDetails->phone }}" disabled />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Địa chỉ</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $activeVendorDetails->address }}" disabled />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Năm đăng ký</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="vendor_join" class="form-control"
                                            value="{{ $activeVendorDetails->vendor_join }}" disabled />
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Giới thiệu shop</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea disabled name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="" rows="3">{{ $activeVendorDetails->vendor_short_info }}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage"
                                            src="{{ !empty($activeVendorDetails->photo) ? url($activeVendorDetails->photo) : url('upload/no_image.jpg') }}"
                                            alt="Vendor" style="width: 100px ; height: 100px;" class="rounded-circle"
                                            disabled>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-secondary px-4"
                                            value="Không cho phép hoạt động" />
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
