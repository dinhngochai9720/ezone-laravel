@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Sản phẩm đã bán hết
@endsection


<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Tồn kho & Hết hàng</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sản phẩm đã bán hết</li>
                </ol>
            </nav>
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
                            <th>Ảnh </th>
                            <th>Tên</th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Danh mục con</th>
                            <th>Giá</th>
                            <th>Giá sau khi giảm</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Ẩn/Hiển thị</th>
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
                                    <span class="badge rounded-pill bg-danger">hết hàng</span>
                                </td>

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
                                </td>



                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Ảnh </th>
                            <th>Tên</th>
                            <th>Thương hiệu</th>
                            <th>Danh mục</th>
                            <th>Danh mục con</th>
                            <th>Giá</th>
                            <th>Giá sau khi giảm</th>
                            <th>Giảm giá</th>
                            <th>Số lượng</th>
                            <th>Trạng thái</th>
                            <th>Ẩn/Hiển thị</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


</div>
@endsection
