@extends('frontend.master_dashboard')
@section('main')
@section('title')
    Bài viết và Tin tức > {{ $name_blog_category->blog_category_name }}
@endsection


<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ url('/') }}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Trang chủ</a>
            <span></span> <a href="{{ url('/blog') }}">Bài viết và Tin tức</a>
            <span></span>{{ $name_blog_category->blog_category_name }}
        </div>
    </div>
</div>


<div class="page-content mb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="loop-grid loop-list pr-30 mb-50">

                    @foreach ($blog_posts as $post)
                        <article class="wow fadeIn animated hover-up mb-30 animated">
                            <div class="post-thumb" style="background-image: url({{ asset($post->post_image) }})">
                                <div class="entry-meta">
                                </div>
                            </div>
                            <div class="entry-content-2 pl-50">
                                <h3 class="post-title mb-20">
                                    <a
                                        href="{{ url('/blog/post-details/' . $post->id . '/' . $post->post_slug) }}">{{ $post->post_title }}</a>
                                </h3>
                                <p class="post-exerpt mb-40">{{ $post->post_short_description }}</p>
                                <div class="entry-meta meta-1 font-xs color-grey mt-10 pb-10">
                                    <div>
                                        <span class="post-on">{{ date('j-n-Y', strtotime($post->created_at)) }}</span>
                                    </div>
                                    <a href="{{ url('/blog/post-details/' . $post->id . '/' . $post->post_slug) }}"
                                        class="text-brand font-heading font-weight-bold">Đọc thêm <i
                                            class="fi-rs-arrow-right"></i></a>
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-3 primary-sidebar sticky-sidebar">
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
                                        href="{{ url('/blog/blog-category/' . $blog_category->id . '/' . $blog_category->blog_category_slug) }}">{{ $blog_category->blog_category_name }}</a><span
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
@endsection
