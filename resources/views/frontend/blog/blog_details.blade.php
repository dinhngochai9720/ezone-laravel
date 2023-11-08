@extends('frontend.master_dashboard')
@section('main')
@section('title')
    {{ $blog_post->post_title }}
@endsection

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> <a href="{{ url('/blog') }}">Bài viết và Tin tức</a> <span></span> <a
                href="{{ url('/blog/blog-category/' . $blog_post->blog_category_id . '/' . $blog_post['blog_category']['blog_category_name']) }}">{{ $blog_post['blog_category']['blog_category_name'] }}</a>
            <span>{{ $blog_post->post_title }} </span>
        </div>
    </div>
</div>

<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-xl-11 col-lg-12 m-auto">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="single-page pt-50 pr-30">
                            <div class="single-header style-2">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <h2 class="mb-10">{{ $blog_post->post_title }}</h2>
                                        <div class="single-header-meta">
                                            <div class="entry-meta meta-1 font-xs mt-15 mb-15">
                                                <a class="author-avatar" href="#">
                                                    <img class="img-circle" src="assets/imgs/blog/author-1.png"
                                                        alt="" />
                                                </a>
                                                <span class="post-by">Admin</span>
                                                {{-- Blog được thêm vào cách đây bao lâu --}}
                                                <span
                                                    class="post-on has-dot">{{ Carbon\Carbon::parse($blog_post->created_at)->locale('vi')->diffForHumans() }}
                                                </span>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <figure class="single-thumbnail">
                                <img src="{{ asset($blog_post->post_image) }}" alt=""
                                    style="width: 100%; height: 300px;" />
                            </figure>

                            <div class="single-content">
                                <div class="row">
                                    <div class="col-xl-10 col-lg-12 m-auto">
                                        <p class="single-excerpt">{!! $blog_post->post_long_description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 primary-sidebar sticky-sidebar pt-50">
                        <div class="widget-area">
                            <div class="sidebar-widget widget-category-2 mb-50">
                                <h5 class="section-title style-1 mb-30">Danh mục</h5>
                                <ul>
                                    @foreach ($blog_categories as $blog_category)
                                        @php
                                            $post = App\Models\BlogPost::where('blog_category_id', $blog_category->id)->get();
                                        @endphp
                                        <li>
                                            <a
                                                href="{{ url('/blog') }}">{{ $blog_category->blog_category_name }}</a><span
                                                class="count">{{ count($post) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Product sidebar widget -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
