@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách danh mục bài viết & tin tức
@endsection

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bài viết & Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách danh mục bài viết & tin tức
                    </li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.blog.category') }}" class="btn btn-success">+ Thêm danh mục </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />


    <h6>Tổng danh mục: <span class="">{{ count($blog_categories) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên danh mục</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blog_categories as $key => $blog_category)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $blog_category->blog_category_name }} </td>
                                <td>
                                    <a href="{{ route('admin.edit.blog.category', $blog_category->id) }}" class="me-2"
                                        title="sửa danh mục"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('admin.delete.blog.category', $blog_category->id) }}"
                                        class="" id="delete" title="xóa danh mục"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Tên danh mục</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
