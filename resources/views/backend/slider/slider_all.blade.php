@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách slider
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách slider</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.slider') }}" class="btn btn-success">+ Thêm slider </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng slider: <span class="">{{ count($sliders) }}</span></h6>
    <hr />



    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Tiêu đề phụ</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key => $slider)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $slider->slider_title }} </td>
                                <td>{{ $slider->slider_subtitle }} </td>
                                <td><img src="{{ asset($slider->slider_image) }}" style="width: 250px; height: 80px;" />
                                </td>
                                <td>
                                    <a href="{{ route('edit.slider', $slider->id) }}" class="me-2"
                                        title="sửa slider"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.slider', $slider->id) }}" class="" id="delete"
                                        title="xóa slider"><i class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Tiêu đề phụ</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
