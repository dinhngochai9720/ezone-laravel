@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Báo cáo theo khách hàng
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
                    <li class="breadcrumb-item active" aria-current="page">Báo cáo theo khách hàng</li>
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

        <form id="myFormUser" action="{{ route('admin.search-by-user') }}" method="POST">
            @csrf
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tìm kiếm theo khách hàng</h5>

                        <div class="form-group">
                            <label class="form-label">Khách hàng:</label>
                            <select name="user" class="form-select mb-2" aria-label="Default select example">
                                <option value="">Chọn khách hàng</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="submit" name="" class="btn btn-rounded btn-primary" value="Tìm kiếm" />

                    </div>


                </div>
            </div>
        </form>




    </div>



</div>



{{-- Validate  Year --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myFormUser').validate({
            rules: {
                user: {
                    required: true,
                },
            },
            messages: {
                user: {
                    required: 'Chưa chọn khách hàng',
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
