@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Thêm danh mục
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Danh mục</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm danh mục</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.category') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('store.category') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="category_name" class="form-control"
                                            placeholder="Nhập tên danh mục" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="category_image" class="form-control"
                                            id="image" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin"
                                            style="width: 100px ; height: 100px;">
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Tạo danh mục" />
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
                category_name: {
                    required: true,
                },
                category_image: {
                    required: true,
                },
            },
            messages: {
                category_name: {
                    required: 'Chưa nhập tên danh mục',
                },

                category_image: {
                    required: 'Chưa chọn ảnh danh mục',
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
