@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách coupon
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Coupon</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách coupon</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.coupon') }}" class="btn btn-success">+ Thêm coupon </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng coupon: <span class="">{{ count($coupons) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Giảm giá</th>
                            <th>Hết hạn</th>
                            <th>Trạng thái</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $key => $coupon)
                            <tr>
                                <td>{{ $key + 1 }}</td>

                                <td>{{ $coupon->coupon_name }} </td>
                                <td>{{ $coupon->coupon_discount }}% </td>

                                <td>{{ date('d-m-Y', strtotime($coupon->coupon_validity)) }}</td>

                                <td>

                                    @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                        <span class="badge rounded-pill bg-success">có hiệu lực</span>
                                    @else
                                        <span class="badge rounded-pill bg-secondary">hết hiệu lực</span>
                                    @endif


                                </td>

                                <td>
                                    <a href="{{ route('edit.coupon', $coupon->id) }}" class="me-2"
                                        title="sửa coupon"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('delete.coupon', $coupon->id) }}" class="" id="delete"
                                        title="xóa coupon"><i class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Giảm giá</th>
                            <th>Hết hạn</th>
                            <th>Trạng thái</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
