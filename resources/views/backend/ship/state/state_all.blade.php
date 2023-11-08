@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách đường/phường/xã
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
                    <li class="breadcrumb-item active" aria-current="page">Danh sách đường/phường/xã</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.state') }}" class="btn btn-success">+ Thêm đường/phường/xã </a>
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
                            <th>Tên thành phố/tỉnh</th>
                            <th>Tên quận/huyện</th>
                            <th>Tên đường/phường/xã</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($states as $key => $state)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $state['division']['division_name'] }} </td>
                                <td>{{ $state['district']['district_name'] }} </td>
                                <td>{{ $state->state_name }} </td>

                                <td>
                                    <a href="{{ route('edit.state', $state->id) }}" class="me-2"
                                        title="sửa đường/phường/xã"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.state', $state->id) }}" class="" id="delete"
                                        title="xóa đường/phường/xã"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tên thành phố/tỉnh</th>
                            <th>Tên quận/huyện</th>
                            <th>Tên đường/phường/xã</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
