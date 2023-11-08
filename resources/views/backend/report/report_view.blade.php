@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Báo cáo
@endsection



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Báo cáo</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Báo cáo theo ngày/tháng/năm</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-3 row-cols-xl-3">

        <form id="myFormDate" action="{{ route('admin.search-by-date') }}" method="POST">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Tìm kiếm báo cáo theo ngày</h5>
                        <div class="form-group mb-2">
                            <label class="form-label">Ngày:</label>
                            <input type="date" name="date" class="form-control" />
                        </div>
                        <input type="submit" name="" class="btn btn-rounded btn-primary" value="Tìm kiếm" />

                    </div>


                </div>
            </div>
        </form>


        <form id="myFormMonth" action="{{ route('admin.search-by-month') }}" method="POST">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="form-group card-body">
                        <h5 class="card-title">Tìm kiếm báo cáo theo tháng</h5>
                        <div class="form-group">
                            <label class="form-label">Tháng:</label>
                            <select name="month" class="form-select mb-2" aria-label="Default select example">
                                <option value="">Chọn tháng</option>
                                <option value="Janurary">1</option>
                                <option value="February">2</option>
                                <option value="March">3</option>
                                <option value="April">4</option>
                                <option value="May">5</option>
                                <option value="June">6</option>
                                <option value="July">7</option>
                                <option value="August">8</option>
                                <option value="September">9</option>
                                <option value="October">10</option>
                                <option value="November">11</option>
                                <option value="December">12</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Năm:</label>
                            <select name="month_year" class="form-select mb-2" aria-label="Default select example">
                                <option value="">Chọn năm</option>
                                <script>
                                    const currentMonthYear = new Date().getFullYear();
                                    for (let i = currentMonthYear; i <= currentMonthYear + 7; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                        <input type="submit" name="" class="btn btn-rounded btn-primary" value="Tìm kiếm" />
                    </div>
                </div>
            </div>
        </form>



        <form id="myFormYear" action="{{ route('admin.search-by-year') }}" method="POST">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tìm kiếm báo cáo theo năm</h5>

                        <div class="form-group">
                            <label class="form-label">Năm:</label>
                            <select name="year" class="form-select mb-2" aria-label="Default select example">
                                <option value="">Chọn năm</option>
                                <script>
                                    const currentYear = new Date().getFullYear();
                                    for (let i = currentYear; i <= currentYear + 7; i++) {
                                        document.write(`<option value="${i}">${i}</option>`);
                                    }
                                </script>
                            </select>
                        </div>
                        <input type="submit" name="" class="btn btn-rounded btn-primary" value="Tìm kiếm" />
                    </div>
                </div>
            </div>
        </form>




    </div>



</div>

{{-- Validate Date --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myFormDate').validate({
            rules: {
                date: {
                    required: true,
                },

            },
            messages: {
                date: {
                    required: 'Chưa chọn ngày',
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

{{-- Validate Month Year --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myFormMonth').validate({
            rules: {
                month: {
                    required: true,
                },
                month_year: {
                    required: true,
                },

            },
            messages: {
                month: {
                    required: 'Chưa chọn tháng',
                },
                month_year: {
                    required: 'Chưa chọn năm',
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


{{-- Validate  Year --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myFormYear').validate({
            rules: {
                year: {
                    required: true,
                },


            },
            messages: {
                year: {
                    required: 'Chưa chọn năm',
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
