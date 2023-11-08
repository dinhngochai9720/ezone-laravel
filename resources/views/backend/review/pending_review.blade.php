@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Đánh giá chờ xử lý
@endsection


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Đánh giá</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Đánh giá chờ xử lý</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <hr />


    <h6>Tổng đánh giá chờ xử lý: <span class="">{{ count($reviews) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Chất lượng</th>
                            <th>Trạng thái</th>
                            <th>Phê duyệt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reviews as $key => $review)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $review['product']['product_name'] }} </td>
                                <td><img src="{{ asset($review['product']['product_thumbnail']) }}"
                                        style="width: 70px; height: 40px;" /></td>
                                <td>{{ $review['user']['fullname'] }} </td>
                                <td>{{ Str::limit($review->comment, 50) }} </td>
                                <td>
                                    @if ($review->rating == null)
                                    @elseif ($review->rating == 1)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif ($review->rating == 2)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif ($review->rating == 3)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif ($review->rating == 4)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-secondary"></i>
                                    @elseif ($review->rating == 5)
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                        <i class="bx bxs-star text-warning"></i>
                                    @endif
                                </td>

                                <td> <span class="badge rounded-pill bg-warning">chờ xử lý</span> </td>

                                <td>
                                    <a href="{{ route('admin.approve.review', $review->id) }}" id="approve-review"
                                        title="phê duyệt"><i class="fa-regular fa-circle-check text-info fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Khách hàng</th>
                            <th>Đánh giá</th>
                            <th>Chất lượng</th>
                            <th>Trạng thái</th>
                            <th>Phê duyệt</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
