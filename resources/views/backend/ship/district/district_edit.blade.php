@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Sửa quận/huyện
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Khu vực giao hàng</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa quận/huyện</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.district') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('update.district') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $district->id }}" />

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên thành phố/tỉnh</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="division_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">Chọn thành phố/tỉnh</option>
                                            @foreach ($divisions as $key => $division)
                                                <option value="{{ $division->id }}"
                                                    {{ $division->id == $district->division_id ? 'selected' : '' }}>
                                                    {{ $division->division_name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên quận/huyện</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="district_name" class="form-control"
                                            value="{{ $district->district_name }}"
                                            placeholder="Nhập tên quận/huyện" />
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
        $('#myForm').validate({
            rules: {
                division_id: {
                    required: true,
                },

                district_name: {
                    required: true,
                },
            },
            messages: {
                division_id: {
                    required: 'Chưa chọn thành phố/tỉnh',
                },
                district_name: {
                    required: 'Chưa nhập tên quận/huyện',
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
