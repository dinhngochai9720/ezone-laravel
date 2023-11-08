@extends('vendor.vendor_dashboard')

@section('vendor')
@section('title')
    Tài khoản
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3"> Tài khoản</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('vendor.dashboard') }}"><i
                                class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thông tin</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-column align-items-center text-center">
                                <img src="{{ !empty($vendorData->photo) ? url($vendorData->photo) : url('upload/no_image.jpg') }}"
                                    alt="Vendor" class="rounded-circle">
                                <div class="mt-3">
                                    <h4>{{ $vendorData->name }}</h4>
                                    <p class="text-secondary mb-1">{{ $vendorData->email }}</p>
                                    <p class="text-muted font-size-sm">{{ $vendorData->address }}</p>

                                </div>
                            </div>
                            <hr class="my-4" />
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <i class="fa-brands fa-facebook fs-5"></i>
                                        Facebook
                                    </h6>
                                    <span class="text-secondary">{{ $vendorData->facebook }}</span>
                                </li>


                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <i class="fa-brands fa-youtube fs-5"></i>
                                        Youtube
                                    </h6>
                                    <span class="text-secondary">{{ $vendorData->youtube }}</span>
                                </li>

                                <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                                    <h6 class="mb-0">
                                        <i class="fa-brands fa-instagram fs-5"></i>
                                        Instagram
                                    </h6>
                                    <span class="text-secondary">{{ $vendorData->instagram }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('vendor.profile.update') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="old_image" value="{{ $vendorData->photo }}" />


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="email" class="form-control" value="{{ $vendorData->email }}"
                                            disabled />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Họ tên</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $vendorData->name }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Shop</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="fullname" class="form-control"
                                            value="{{ $vendorData->fullname }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Điện thoại</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ $vendorData->phone }}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Địa chỉ</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="address" class="form-control"
                                            value="{{ $vendorData->address }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Facebook</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="facebook" class="form-control"
                                            value="{{ $vendorData->facebook }}" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Youtube</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="youtube" class="form-control"
                                            value="{{ $vendorData->youtube }}" />
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Instagram</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="instagram" class="form-control"
                                            value="{{ $vendorData->instagram }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Năm đăng ký</h6>
                                    </div>

                                    @php
                                        $currentYear = date('Y');
                                    @endphp

                                    <div class="col-sm-9 text-secondary">
                                        <select name="vendor_join" class="form-select mb-3"
                                            aria-label="Default select example">
                                            @if ($vendorData->vendor_join)
                                                <option
                                                    {{ $vendorData->vendor_join == $currentYear ? 'selected' : '' }}>
                                                    {{ $currentYear }}</option>
                                            @else
                                                <option value="">Chọn năm đăng ký </option>
                                                <script>
                                                    const currentYear = new Date().getFullYear();
                                                    for (let i = currentYear; i <= currentYear; i++) {
                                                        document.write(`<option value="${i}">${i}</option>`);
                                                    }
                                                </script>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Giới thiệu shop</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="vendor_short_info" class="form-control" id="inputAddress2" placeholder="" rows="3">{{ $vendorData->vendor_short_info }}</textarea>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="file" name="photo" class="form-control" id="image" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage"
                                            src="{{ !empty($vendorData->photo) ? url($vendorData->photo) : url('upload/no_image.jpg') }}"
                                            alt="Vendor" style="width: 100px ; height: 100px;"
                                            class="rounded-circle">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Cập nhật" />
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

<script type="text/javascript">
    $(document).ready(function() {
        // Show image after upload image
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
