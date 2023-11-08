@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Thêm banner
@endsection


{{-- Jquery CDN  --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Banner</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm banner</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.banner') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('store.banner') }}"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tiêu đề </h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="banner_title" class="form-control"
                                            placeholder="Nhập tiêu đề banner" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> URL</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="banner_url" class="form-control"
                                            placeholder="Nhập URL banner" />
                                    </div>
                                </div>

                                <div class=" row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"> Ảnh</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="banner_image" class=" form-control"
                                            id="image" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Slider"
                                            style="width: 50% ; height: 150px;">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Tạo Banner" />
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
        // Validate
        $('#myForm').validate({
            rules: {
                banner_title: {
                    required: true,
                },
                banner_url: {
                    required: true,
                },
                banner_image: {
                    required: true,
                },
            },
            messages: {
                banner_title: {
                    required: 'Chưa nhập tiêu đề banner',
                },
                banner_url: {
                    required: 'Chưa nhập URL banner',
                },
                banner_image: {
                    required: 'Chưa chọn ảnh banner',
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
