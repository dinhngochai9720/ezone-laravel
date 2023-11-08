<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BannerController extends Controller
{
    //
    public function AllBanner()
    {
        $banners = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banners'));
    }

    public function AddBanner()
    {
        return view('backend.banner.banner_add');
    }

    public function StoreBanner(Request $request)
    {
        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
        Image::make($image)->resize(768, 450)->save('upload/banner/' . $name_gen);
        $save_url = 'upload/banner/' . $name_gen;

        Banner::insert([
            "banner_title" => $request->banner_title,
            "banner_url" => $request->banner_url,
            "banner_image" => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.banner')->with($notification);
    }
    public function EditBanner($id)
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banner'));
    }

    public function UpdateBanner(Request $request)
    {
        $banner_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('banner_image')) {
            $image = $request->file('banner_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(768, 450)->save('upload/banner/' . $name_gen);
            $save_url = 'upload/banner/' . $name_gen;

            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Banner::findOrFail($banner_id)->update([
                "banner_title" => $request->banner_title,
                "banner_url" => $request->banner_url,
                "banner_image" => $save_url,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->route('all.banner')->with($notification);
        } else {
            Banner::findOrFail($banner_id)->update([
                "banner_title" => $request->banner_title,
                "banner_url" => $request->banner_url,
                'updated_at' => Carbon::now(),

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->route('all.banner')->with($notification);
        }
    }

    public function DeleteBanner($id)
    {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        unlink($img);

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }
}
