@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách thành phố/tỉnh
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách thành phố/tỉnh</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.division') }}" class="btn btn-success">+ Thêm thành phố/tỉnh </a>
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
                            <th>Tên thành phố</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($divisions as $key => $division)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $division->division_name }} </td>

                                <td>
                                    <a href="{{ route('edit.division', $division->id) }}" class="me-2"
                                        title="sửa thành phố/tỉnh"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.division', $division->id) }}" class="" id="delete"
                                        title="xóa thành phố/tỉnh"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#No</th>
                            <th>Tên thành phố</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
