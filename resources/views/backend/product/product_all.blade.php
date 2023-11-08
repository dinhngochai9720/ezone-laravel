@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách sản phẩm
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Sản phẩm</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('add.product') }}" class="btn btn-success">+ Thêm sản phẩm </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />

    <h6>Tổng sản phẩm: <span class="">{{ count($products) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Danh mục con</th>
                            <th>Giá</th>
                            <th>Giá sau khi giảm</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset($product->product_thumbnail) }}"
                                        style="width: 70px; height: 40px;" /></td>
                                <td>{{ $product->product_name }} </td>
                                <td>{{ $product['brand']['brand_name'] }} </td>
                                <td>{{ $product['category']['category_name'] }} </td>
                                <td>{{ $product['subcategory']['subcategory_name'] }} </td>
                                <td>{{ number_format($product->selling_price, 0, '.', '.') }}₫ </td>
                                <td>{{ number_format($product->discount_price, 0, '.', '.') }}₫ </td>

                                <td>
                                    @php
                                        $amount = abs($product->selling_price - $product->discount_price);
                                        $discount = ($amount / $product->selling_price) * 100;
                                    @endphp

                                    @if ($product->selling_price == $product->discount_price)
                                        <span class="badge rounded-pill bg-secondary">
                                            không giảm giá</span>
                                    @elseif ($product->selling_price < $product->discount_price)
                                        <span class="badge rounded-pill bg-success">
                                            + {{ round($discount) }}%</span>
                                    @else
                                        <span class="badge rounded-pill bg-danger">
                                            - {{ round($discount) }}%</span>
                                    @endif



                                </td>

                                <td>

                                    @if ($product->product_qty <= 0)
                                        <span class="badge rounded-pill bg-danger">hết hàng</span>
                                    @else
                                        {{ $product->product_qty }}
                                </td>
                        @endif


                        <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>

                        <td>
                            @if ($product->status == 1)
                                <span class="badge rounded-pill bg-success">hiển thị</span>
                            @else
                                <span class="badge rounded-pill bg-secondary">ẩn</span>
                            @endif

                        </td>



                        <td>
                            @if ($product->status == 1)
                                <a href="{{ route('inactive.product', $product->id) }}" class="me-2"
                                    title="ẩn sản phẩm"><i
                                        class="fa-solid fa-thumbs-down fs-6 text-secondary"></i></a>
                            @else
                                <a href="{{ route('active.product', $product->id) }}" class="me-2"
                                    title="hiển thị sản phẩm"><i
                                        class="fa-solid fa-thumbs-up fs-6 text-success"></i></a>
                            @endif

                            <a href="{{ route('edit.product', $product->id) }}" class="me-2"
                                title="sửa sản phẩm"><i class="fa-regular fa-pen-to-square text-info fs-6"></i></a>

                            {{-- <a href="{{route('edit.product',$product->id)}}" class="me-2" title="view-product"><i class="fa-regular fa-eye text-primary fs-6"></i></a> --}}

                            <a href="{{ route('delete.product', $product->id) }}" class="" id="delete"
                                title="xóa sản phẩm"><i class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                        </td>
                        </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ảnh</th>
                            <th>Tên</th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Danh mục con</th>
                            <th>Giá</th>
                            <th>Giá sau khi giảm</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Ngày tạo</th>
                            <th>Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
