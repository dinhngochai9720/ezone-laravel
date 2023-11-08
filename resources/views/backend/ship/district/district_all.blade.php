@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách quận/huyện
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Khu vực giao hàng</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách quận/huyện</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.district') }}" class="btn btn-success">+ Thêm quận/huyện </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Thành phố/tỉnh</th>
                            <th>Tên quận</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $key => $district)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $district['division']['division_name'] }} </td>
                                <td>{{ $district->district_name }} </td>

                                <td>
                                    <a href="{{ route('edit.district', $district->id) }}" class="me-2"
                                        title="sửa quận/huyện"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.district', $district->id) }}" class="" id="delete"
                                        title="xóa quận/huyện"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Thành phố/tỉnh</th>
                            <th>Tên quận</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
