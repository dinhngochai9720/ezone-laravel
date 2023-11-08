@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách thương hiệu
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Thương hiệu</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách thương hiệu</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.brand') }}" class="btn btn-success">+ Thêm thương hiệu </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng thương hiệu: <span class="">{{ count($brands) }}</span></h6>
    <hr />


    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $brand->brand_name }} </td>
                                <td><img src="{{ asset($brand->brand_image) }}" style="width: 70px; height: 40px;" />
                                </td>
                                <td>
                                    <a href="{{ route('edit.brand', $brand->id) }}" class="me-2"
                                        title="sửa thương hiệu"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.brand', $brand->id) }}" class="" id="delete"
                                        title="xóa thương hiệu"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
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
