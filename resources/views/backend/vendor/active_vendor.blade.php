@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách nhà cung cấp được phép hoạt động
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Nhà cung cấp</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách nhà cung cấp được phép hoạt
                        động</li>
                </ol>
            </nav>
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
                            <th>Họ tên</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Email</th>
                            <th>Năm đăng ký</th>
                            <th>Trạng thái</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeVendors as $key => $activeVendor)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $activeVendor->name }} </td>
                                <td>{{ $activeVendor->fullname }} </td>
                                <td>{{ $activeVendor->email }} </td>
                                <td>{{ $activeVendor->vendor_join }} </td>
                                <td>
                                    <span class="badge rounded-pill bg-success">được phép hoạt động</span>
                                </td>
                                <td>
                                    <a href="{{ route('active.vendor.details', $activeVendor->id) }}" class=""
                                        title="xem chi tiết nhà cung cấp"><i
                                            class="fa-regular fa-eye text-primary fs-6"></i></a>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Họ tên</th>
                            <th>Tên nhà cung cấp</th>
                            <th>Email</th>
                            <th>Năm đăng ký</th>
                            <th>Trạng thái</th>
                            <th>Xem</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
