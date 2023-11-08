@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Thêm nhiều ảnh
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sản phẩm</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Thêm nhiều ảnh</li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <a href="{{ route('all.product') }}" class="btn btn-primary"><i
                    class="fa-solid fa-circle-arrow-left"></i><span>Quay lại</span></a>
        </div>

    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Thêm nhiều ảnh </h5>
            <hr />

            <form id="myForm" method="POST" action="{{ route('store.product.multi_image') }}"
                enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{ $product_id }}" />

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="border border-3 p-4 rounded">


                                <div class="form-group mb-3">
                                    <label for="multiImage" class="form-label">Chọn nhiều ảnh</label>
                                    <input name="multi_img[]" class="form-control" type="file" id="multiImg"
                                        multiple required title="Chưa chọn ảnh">

                                    <div class="row mt-2" id="preview_img"></div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!--end row-->
                </div>

                <button type="submit" class="btn btn-primary mt-4 fs-6">Cập nhật</button>
            </form>
        </div>
    </div>
</div>


{{-- Show Multi Image --}}
<script>
    $(document).ready(function() {
        $('#multiImg').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                        .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(100)
                                    .height(100); //create image element 
                                $('#preview_img').append(
                                img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
@endsection
