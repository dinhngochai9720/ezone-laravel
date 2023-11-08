<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BlogController extends Controller
{
    //Blog Category
    public function AllBlogCategory()
    {
        $blog_categories = BlogCategory::latest()->get();

        return view('backend.blog.blog_category.blog_category_all', compact('blog_categories'));
    }


    public function AddBlogCategory()
    {
        return view('backend.blog.blog_category.blog_category_add');
    }


    public function StoreBlogCategory(Request $request)
    {


        BlogCategory::insert([
            "blog_category_name" => $request->blog_category_name,
            "blog_category_slug" => strtolower(str_replace(' ', '-', $request->blog_category_name)),
            "created_at" => Carbon::now(),

        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('admin.all.blog.category')->with($notification);
    }


    public function EditBlogCategory($id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        return view('backend.blog.blog_category.blog_category_edit', compact('blog_category'));
    }

    public function UpdateBlogCategory(Request $request)
    {
        $blog_category_id = $request->id;
        BlogCategory::findOrFail($blog_category_id)->update([
            "blog_category_name" => $request->blog_category_name,
            "blog_category_slug" => strtolower(str_replace(' ', '-', $request->blog_category_name)),

        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );
        return redirect()->route('admin.all.blog.category')->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    // Blog Post
    public function AllBlogPost()
    {
        $blog_posts = BlogPost::latest()->get();

        return view('backend.blog.blog_post.blog_post_all', compact('blog_posts'));
    }

    public function AddBlogPost()
    {

        $blog_categories = BlogCategory::orderBy('blog_category_name', 'ASC')->get();
        return view('backend.blog.blog_post.blog_post_add', compact('blog_categories'));
    }


    public function StoreBlogPost(Request $request)
    {
        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
        Image::make($image)->resize(1103, 906)->save('upload/blog_post/' . $name_gen);
        $save_url = 'upload/blog_post/' . $name_gen;

        BlogPost::insert([
            "blog_category_id" => $request->blog_category_id,
            "post_title" => $request->post_title,
            "post_slug" => strtolower(str_replace(' ', '-', $request->post_title)),
            "post_short_description" => $request->post_short_description,
            "post_long_description" => $request->post_long_description,
            "post_image" => $save_url,
            "created_at" => Carbon::now(),

        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );

        return redirect()->route('admin.all.blog.post')->with($notification);
    }

    public function EditBlogPost($id)
    {
        $blog_categories = BlogCategory::orderBy('blog_category_name', 'ASC')->get();
        $blog_post = BlogPost::findOrFail($id);
        return view('backend.blog.blog_post.blog_post_edit', compact('blog_post', 'blog_categories'));
    }


    public function UpdateBlogPost(Request $request)
    {
        $blog_post_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(1103, 906)->save('upload/blog_post/' . $name_gen);
            $save_url = 'upload/blog_post/' . $name_gen;

            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            BlogPost::findOrFail($blog_post_id)->update([
                "blog_category_id" => $request->blog_category_id,
                "post_title" => $request->post_title,
                "post_slug" => strtolower(str_replace(' ', '-', $request->post_title)),
                "post_short_description" => $request->post_short_description,
                "post_long_description" => $request->post_long_description,
                "post_image" => $save_url,
                "updated_at" => Carbon::now(),

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->route('admin.all.blog.post')->with($notification);
        } else {
            BlogPost::findOrFail($blog_post_id)->update([
                "blog_category_id" => $request->blog_category_id,
                "post_title" => $request->post_title,
                "post_slug" => strtolower(str_replace(' ', '-', $request->post_title)),
                "post_short_description" => $request->post_short_description,
                "post_long_description" => $request->post_long_description,
                "updated_at" => Carbon::now(),

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );
            return redirect()->route('admin.all.blog.post')->with($notification);
        }
    }

    public function DeleteBlogPost($id)
    {
        $blog_post = BlogPost::findOrFail($id);
        $img = $blog_post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    // Frontend
    public function AllPost()
    {
        $blog_categories = BlogCategory::latest()->get();
        $blog_posts = BlogPost::paginate(2);

        // dd($blog_posts);
        return view('frontend.blog.home_blog', compact('blog_categories', 'blog_posts'));
    }

    public function DetailsPost($id, $slug)
    {

        $blog_categories = BlogCategory::latest()->get();
        $blog_post = BlogPost::where('id', $id)->first();

        return view('frontend.blog.blog_details', compact('blog_categories', 'blog_post'));
    }

    public function BlogCategoryPost($id, $slug)
    {
        $blog_categories = BlogCategory::latest()->get();
        $blog_posts = BlogPost::where('blog_category_id', $id)->get();
        $name_blog_category = BlogCategory::where('id', $id)->first();

        return view('frontend.blog.blog_category_post', compact('blog_categories', 'blog_posts', 'name_blog_category'));
    }
}
