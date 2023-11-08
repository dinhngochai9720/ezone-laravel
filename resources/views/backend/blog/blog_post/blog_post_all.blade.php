@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Danh sách bài viết & tin tức
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Bài viết & Tin tức</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Danh sách bài viết & tin tức</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{ route('admin.add.blog.post') }}" class="btn btn-success">+ Thêm bài viết & tin tức </a>
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <hr />


    <h6>Tổng bài viết & tin tức: <span class="">{{ count($blog_posts) }}</span></h6>
    <hr />

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Danh mục</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blog_posts as $key => $blog_post)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $blog_post['blog_category']['blog_category_name'] }} </td>
                                <td> {{ $blog_post->post_title }}</td>
                                <td><img src="{{ asset($blog_post->post_image) }}"
                                        style="width: 150px; height: 80px;" /></td>
                                <td>
                                    <a href="{{ route('admin.edit.blog.post', $blog_post->id) }}" class="me-2"
                                        title="sửa bài viết & tin tức"><i
                                            class="fa-regular fa-pen-to-square text-info fs-6"></i></a>
                                    <a href="{{ route('admin.delete.blog.post', $blog_post->id) }}" class=""
                                        id="delete" title="xóa bài viết & tin tức"><i
                                            class="fa-regular fa-trash-can text-danger fs-6"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Danh mục</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th>Sửa/Xóa</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
