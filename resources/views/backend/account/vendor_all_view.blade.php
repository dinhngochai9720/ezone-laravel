@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách tài khoản nhà cung cấp
@endsection


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tài khoản</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản nhà cung cấp</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng tài khoản: <span class="">{{ count($vendors) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Email</th>
                            <th>Họ tên</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vendors as $key => $vendor)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ !empty($vendor->photo) ? url($vendor->photo) : url('upload/no_image.jpg') }}"
                                        class="rounded-circle" style="width: 60px; height: 60px;" /></td>
                                <td>{{ $vendor->email }} </td>
                                <td>{{ $vendor->name }} </td>
                                <td>{{ $vendor->fullname }} </td>
                                <td>{{ $vendor->phone }} </td>
                                <td>{{ $vendor->address }} </td>
                                <td>
                                    @if ($vendor->status == 'active')
                                        <span class="badge rounded-pill bg-success">được phép hoạt động</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">không được phép hoạt
                                            động</span>
                                    @endif

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Email</th>
                            <th>Họ tên</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Trạng thái</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
