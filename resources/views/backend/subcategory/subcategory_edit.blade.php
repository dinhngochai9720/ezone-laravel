@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Sửa danh mục con
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Danh mục con</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa danh mục con</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <a href="{{ route('all.subcategory') }}" class="btn btn-primary"><i
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

                            <form id="myForm" method="POST" action="{{ route('update.subcategory') }}">
                                @csrf

                                <input type="hidden" name="id" value="{{ $subcategory->id }}" />

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên danh mục</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <select name="category_id" class="form-select mb-3"
                                            aria-label="Default select example">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $key => $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach


                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tên danh mục con</h6>
                                    </div>
                                    <div class="form-group col-sm-9 text-secondary">
                                        <input type="text" name="subcategory_name" class="form-control"
                                            value="{{ $subcategory->subcategory_name }}"
                                            placeholder="Nhập tên danh mục con" />
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
                category_id: {
                    required: true,
                },

                subcategory_name: {
                    required: true,
                },
            },
            messages: {
                category_id: {
                    required: 'Chưa chọn tên danh mục',
                },
                subcategory_name: {
                    required: 'Chưa nhập tên danh mục con',
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
