@extends('vendor.vendor_dashboard')

@section('vendor')
@section('title')
    Sửa sản phẩm
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
                    <li class="breadcrumb-item active" aria-current="page">Sửa sản phẩm</li>
                </ol>
            </nav>
        </div>


        <div class="ms-auto">
            <a href="{{ route('vendor.all.product') }}" class="btn btn-primary"><i
                    class="fa-solid fa-circle-arrow-left"></i><span>Quay lại</span></a>
        </div>


    </div>
    <!--end breadcrumb-->

    <div class="card">
        <div class="card-body p-4">
            <h5 class="card-title">Sửa sản phẩm</h5>
            <hr />

            <form id="myForm" method="POST" action="{{ route('vendor.update.product') }}">
                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}" />

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="border border-3 p-4 rounded">

                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label">Tên sản phẩm</label>
                                    <input type="text" name="product_name" class="form-control"
                                        id="inputProductTitle" value="{{ $product->product_name }}">
                                </div>


                                <div class="form-group mb-3">
                                    <label for="inputProductTitle" class="form-label"> Tags</label>
                                    <input type="text" name="product_tags" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ $product->product_tags }}">
                                </div>

                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label"> Size</label>
                                    <input type="text" name="product_size" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ $product->product_size }}">
                                </div>



                                <div class="mb-3">
                                    <label for="inputProductTitle" class="form-label"> Màu</label>
                                    <input type="text" name="product_color" class="form-control visually-hidden"
                                        data-role="tagsinput" value="{{ $product->product_color }}">
                                </div>



                                <div class="form-group mb-3">
                                    <label for="inputProductDescription" class="form-label">Miêu tả ngắn sản
                                        phẩm</label>
                                    <textarea name="short_description" class="form-control" id="inputProductDescription" rows="3">{{ $product->short_description }}</textarea>
                                </div>


                                <div class="mb-3">
                                    <label for="inputProductDescription" class="form-label">Miêu tả chi tiết sản
                                        phẩm</label>
                                    <textarea id="mytextarea" name="long_description">{!! $product->long_description !!}</textarea>
                                </div>




                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="border border-3 p-4 rounded">
                                <div class="row g-3">
                                    <div class="form-group col-md-6">
                                        <label for="inputPrice" class="form-label">Giá</label>
                                        <input type="number" name="selling_price" class="form-control" id="inputPrice"
                                            value="{{ $product->selling_price }}" min="0">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputCompareatprice" class="form-label">Giá sau khi giảm</label>
                                        <input type="number" name="discount_price" class="form-control"
                                            id="inputCompareatprice" value="{{ $product->discount_price }}"
                                            min="0">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputCostPerPrice" class="form-label">Code</label>
                                        <input type="text" name="product_code" class="form-control"
                                            id="inputCostPerPrice" value="{{ $product->product_code }}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputStarPoints" class="form-label"> Số lượng</label>
                                        <input type="number" name="product_qty" class="form-control"
                                            id="inputStarPoints" value="{{ $product->product_qty }}" min="0"
                                            title="Số lượng sản phẩm > 0">
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputProductType" class="form-label">Thương hiệu</label>
                                        <select name="brand_id" class="form-select" id="inputProductType">
                                            <option value="">Chọn thương hiệu</option>
                                            @foreach ($brands as $key => $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $brand->id == $product->brand_id ? 'selected' : '' }}>
                                                    {{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputVendor" class="form-label">Danh mục</label>
                                        <select name="category_id" class="form-select" id="inputVendor">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $key => $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inputCollection" class="form-label">Danh mục con</label>
                                        <select name="subcategory_id" class="form-select" id="inputCollection">
                                            <option value="">Chọn danh mục con</option>
                                            @foreach ($subcategories as $key => $subcategory)
                                                <option value="{{ $subcategory->id }}"
                                                    {{ $subcategory->id == $product->subcategory_id ? 'selected' : '' }}>
                                                    {{ $subcategory->subcategory_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input name="hot_deals" class="form-check-input" type="checkbox"
                                                        value="1" id="flexCheckDefault"
                                                        {{ $product->hot_deals == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Ưu đãi
                                                        lớn</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input name="featured" class="form-check-input" type="checkbox"
                                                        value="1" id="flexCheckDefault"
                                                        {{ $product->featured == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Sản phẩm
                                                        đặc sắc</label>
                                                </div>
                                            </div>



                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input name="special_offer" class="form-check-input"
                                                        type="checkbox" value="1" id="flexCheckDefault"
                                                        {{ $product->special_offer == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Đề nghị
                                                        đặc biệt</label>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input name="special_deals" class="form-check-input"
                                                        type="checkbox" value="1" id="flexCheckDefault"
                                                        {{ $product->special_deals == 1 ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="flexCheckDefault">Ưu đãi đặc
                                                        biệt</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <hr />

                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
        </div>
        </form>
    </div>

</div>

{{-- Main Image Update --}}
<div class="page-content">
    <h6 class="mb-0 ">Cập nhật ảnh chính</h6>
    <hr />

    <div class="card">
        <form method="POST" action="{{ route('vendor.update.product.main_image_thumbnail') }}"
            enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}" />
            <input type="hidden" name="old_main_image_thumbnail" value="{{ $product->product_thumbnail }}" />

            <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Chọn ảnh chính</label>
                    <input name="product_thumbnail" class="form-control" type="file" id="formFile">
                </div>

                <div class="mb-3">
                    <label for="formFile" class="form-label"></label>
                    <img src="{{ asset($product->product_thumbnail) }}" style="width: 100px; height: 100px;"
                        class="mt-2" />
                </div>

                <button type="submit" class="btn btn-primary">Cập nhật</button>


            </div>

        </form>
    </div>
</div>

{{-- Update Multi Image --}}
<div class="page-content">
    <div class="d-flex justify-content-between">
        <h6 class="mb-0 ">Thêm nhiều ảnh</h6>
        <div class="btn-group">
            <a href="{{ route('vendor.add.product.multi_image', $product->id) }}" class="btn btn-success">+ Thêm</a>
        </div>
    </div>

    <hr />



    <div class="card">
        <div class="card-body">
            <table class="table mb-0 table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Chọn ảnh</th>
                        <th scope="col">Hoạt động</th>
                    </tr>
                </thead>
                <tbody>
                    <form method="POST" action="{{ route('vendor.update.product.multi_image') }}"
                        enctype="multipart/form-data">
                        @csrf

                        @foreach ($multiImgs as $key => $img)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>
                                    <img src="{{ asset($img->photo_name) }}" style="width: 80px; height: 80px;"
                                        class="mt-2" />
                                </td>

                                <td>
                                    <input type="file" class="form-group"
                                        name="multi_img[{{ $img->id }}]" />
                                </td>

                                <td>
                                    <button type="submit" class="btn btn-primary me-2 fs-6">Cập nhật</button>

                                    <a href="{{ route('vendor.delete.product.multi_image', $img->id) }}"
                                        class="" id="delete" title="xóa ảnh"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </tbody>

            </table>
        </div>

    </div>
</div>





{{-- Show Main Image --}}
<script type="text/javascript">
    function mainThumbnailUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThumbnail').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }

    }
</script>


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
                                    .height(80); //create image element 
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

<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{ url('/vendor/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcategory_id"]').html('');

                        var d = $('select[name="subcategory_id"]').empty();

                        $.each(data, function(key, value) {
                            $('select[name="subcategory_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .subcategory_name + '</option>');

                        });
                    },
                });
            } else {
                alert('Warning! Something went wrong')
            }
        });
    });
</script>

{{-- Validate --}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                product_name: {
                    required: true,
                },
                short_description: {
                    required: true,
                },
                product_thumbnail: {
                    required: true,
                },
                // multi_img: {
                //     required : true,
                // }, 
                selling_price: {
                    required: true,
                },
                discount_price: {
                    required: true,
                },

                product_code: {
                    required: true,
                },
                product_qty: {
                    required: true,
                },
                brand_id: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                subcategory_id: {
                    required: true,
                },
                product_tags: {
                    required: true,
                },
                // product_size: {
                //     required : true,
                // },
                // product_color: {
                //     required : true,
                // },
            },
            messages: {
                product_name: {
                    required: 'Nhập tên sản phẩm',
                },
                short_description: {
                    required: 'Miêu tả ngắn sản phẩm',
                },
                product_thumbnail: {
                    required: 'Chọn ảnh chính cho sản phẩm',
                },
                // multi_img: {
                //     required : 'Please Choose Multi Image',
                // },
                selling_price: {
                    required: 'Nhập giá sản phẩm',
                },

                discount_price: {
                    required: 'Nhập giá sau khi giảm giá sản phẩm',
                },

                product_code: {
                    required: 'Nhập code sản phẩm',
                },
                product_qty: {
                    required: 'Nhập số lượng sản phẩm',
                },
                brand_id: {
                    required: 'Chọn thương hiệu sản phẩm',
                },
                category_id: {
                    required: 'Chọn danh mục sản phẩm',
                },
                subcategory_id: {
                    required: 'Chọn danh mục con sản phẩm',
                },
                product_tags: {
                    required: 'Nhập tags cho sản phẩm',
                },
                // product_size: {
                //     required : 'Please Enter Product Size',
                // },
                // product_color: {
                //     required : 'Please Enter Product Color',
                // },
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
