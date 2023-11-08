@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Sửa bài viết & tin tức
@endsection

{{-- Validate myForm --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bài viết & Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa bài viết & tin tức</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('admin.all.blog.post') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('admin.update.blog.post') }}"
                                enctype="multipart/form-data">
                                @csrf


                                <input type="hidden" name="id" value="{{ $blog_post->id }}" />
                                <input type="hidden" name="old_image" value="{{ $blog_post->post_image }}" />

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Danh mục</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="blog_category_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($blog_categories as $key => $blog_category)
                                                <option value="{{ $blog_category->id }}"
                                                    {{ $blog_category->id == $blog_post->blog_category_id ? 'selected' : '' }}>
                                                    {{ $blog_category->blog_category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tiêu đề</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="post_title" class="form-control"
                                            placeholder="Nhập tiêu đề" value="{{ $blog_post->post_title }}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Miêu tả ngắn</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <textarea name="post_short_description" class="form-control" id="post_short_description" rows="3">{{ $blog_post->post_short_description }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Bài viết chi tiết</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <textarea id="mytextarea" name="post_long_description" id="post_long_description" required>{!! $blog_post->post_long_description !!}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Ảnh</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="file" name="post_image" class="form-control" id="image" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img id="showImage" src="{{ asset($blog_post->post_image) }}"
                                            alt="blog-post-image" style="width: 300px ; height: 150px;">
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
        // Validate
        $('#myForm').validate({
            rules: {
                blog_category_id: {
                    required: true,
                },
                post_title: {
                    required: true,
                },
                post_short_description: {
                    required: true,
                },


            },
            messages: {
                blog_category_id: {
                    required: 'Chưa chọn danh mục',
                },
                post_title: {
                    required: 'Chưa nhập tiêu đề',
                },

                post_short_description: {
                    required: 'Chưa nhập miêu tả ngắn',
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
