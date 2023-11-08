@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Sửa đường/phường/xã
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa đường/phường/xã</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.state') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('update.state') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $state->id }}" />

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
                                                    {{ $division->id == $state->division_id ? 'selected' : '' }}>
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
                                        <select name="district_id" class="form-select" id="inputCollection">
                                            <option value="">Chọn quận/huyện</option>
                                            @foreach ($districts as $key => $district)
                                                <option value="{{ $district->id }}"
                                                    {{ $district->id == $state->district_id ? 'selected' : '' }}>
                                                    {{ $district->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên đường/phường/xã</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="state_name" class="form-control"
                                            value="{{ $state->state_name }}"
                                            placeholder="Nhập tên đường/phường/xã" />
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
        $('select[name="division_id"]').on('change', function() {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{ url('/district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="district_id"]').html('');

                        var d = $('select[name="district_id"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');

                        });
                    },
                });
            } else {
                alert('Đã có lỗi xảy ra')
            }
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                division_id: {
                    required: true,
                },

                district_id: {
                    required: true,
                },

                state_name: {
                    required: true,
                },
            },
            messages: {
                division_id: {
                    required: 'Chưa chọn thành phố/tỉnh',
                },
                district_id: {
                    required: 'Chưa chọn quận/huyện',
                },
                state_name: {
                    required: 'Chưa nhập tên đường/phường/xã',
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
