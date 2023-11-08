@extends('admin.admin_dashboard')

@section('admin')
@section('title')
    Đổi mật khẩu
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Đổi mật khẩu</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Đổi mật khẩu tài khoản</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.update.password') }}">
                                @csrf

                                @if (session('success'))
                                    <div class="alert alert-success text-center" role="alert">
                                        {{ session('success') }}
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger text-center" role="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <div class="row mb-3">
                                    <div class="col-sm-3 d-flex  ">
                                        <h6 class="mb-0">Mật khẩu cũ</h6>
                                    </div>

                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="old_password"
                                            class="form-control 
                                            @error('old_password')
                                                is-invalid
                                            @enderror"
                                            placeholder="Nhập mật khẩu cũ" />

                                        @error('old_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 d-flex ">
                                        <h6 class="mb-0">Mật khẩu mới</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password"
                                            class="form-control
                                            @error('new_password') is-invalid @enderror"
                                            placeholder="Nhập mật khẩu mới" />

                                        @error('new_password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-3 d-flex  ">
                                        <h6 class="mb-0">Xác nhận mật khẩu</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            placeholder="Nhập lại mật khẩu mới" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3"></div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="submit" class="btn btn-primary px-4" value="Đổi mật khẩu" />
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
