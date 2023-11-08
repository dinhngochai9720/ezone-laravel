@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách banner
@endsection


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Banner</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách banner</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.banner') }}" class="btn btn-success" title="add-banner">+ Thêm Banner</a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng Banner: <span class="">{{ count($banners) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>URL</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($banners as $key => $banner)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $banner->banner_title }} </td>
                                <td>{{ $banner->banner_url }} </td>
                                <td><img src="{{ asset($banner->banner_image) }}" style="width: 150px; height: 80px;" />
                                </td>
                                <td>
                                    <a href="{{ route('edit.banner', $banner->id) }}" class="me-2"
                                        title="sửa banner"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.banner', $banner->id) }}" class="" id="delete"
                                        title="xóa banner"><i class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>URL</th>
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
