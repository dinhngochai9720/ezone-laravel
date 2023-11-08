@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách tài khoản người dùng
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách tài khoản người dùng</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng tài khoản: <span class="">{{ count($users) }}</span></h6>
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
                            <th>Họ tên</th>
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ !empty($user->photo) ? url($user->photo) : url('upload/no_image.jpg') }}"
                                        class="rounded-circle" style="width: 60px; height: 60px;" /></td>
                                <td>{{ $user->email }} </td>
                                <td>{{ $user->fullname }} </td>
                                <td>{{ $user->name }} </td>
                                <td>{{ $user->phone }} </td>
                                <td>{{ $user->address }} </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Email</th>
                            <th>Họ tên</th>
                            <th>Tên</th>
                            <th>Điện thoại</th>
                            <th>Địa chỉ</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
