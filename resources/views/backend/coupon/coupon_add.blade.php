@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Thêm coupon
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Coupon</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm coupon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.coupon') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('store.coupon') }}">
                                @csrf


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="coupon_name" class="form-control"
                                            placeholder="Nhập tên coupon" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Giảm giá(%)</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="number" name="coupon_discount" class="form-control"
                                            min="0" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Hết hạn</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="date" name="coupon_validity" class="form-control"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Tạo coupon" />
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
        $('#myForm').validate({
            rules: {
                coupon_name: {
                    required: true,
                },
                coupon_discount: {
                    required: true,
                },
                coupon_validity: {
                    required: true,
                },
            },
            messages: {
                coupon_name: {
                    required: 'Chưa nhập tên coupon',
                },
                coupon_discount: {
                    required: 'Chưa nhập giảm giá coupon',
                },
                coupon_validity: {
                    required: 'Chưa chọn thời gian hết hạn coupon',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
@endsection
