<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Image;

class SliderController extends Controller
{
    //
    public function AllSlider()
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }

    public function AddSlider()
    {
        return view('backend.slider.slider_add');
    }

    public function StoreSlider(Request $request)
    {
        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
        Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);
        $save_url = 'upload/slider/' . $name_gen;

        Slider::insert([
            "slider_title" => $request->slider_title,
            "slider_subtitle" => $request->slider_subtitle,
            "slider_image" => $save_url,

        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.slider')->with($notification);
    }
    public function EditSlider($id)
    {
        $slider = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('slider'));
    }

    public function UpdateSlider(Request $request)
    {
        $slider_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(2376, 807)->save('upload/slider/' . $name_gen);
            $save_url = 'upload/slider/' . $name_gen;

            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            Slider::findOrFail($slider_id)->update([
                "slider_title" => $request->slider_title,
                "slider_subtitle" =>  $request->slider_subtitle,
                "slider_image" => $save_url,

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->route('all.slider')->with($notification);
        } else {
            Slider::findOrFail($slider_id)->update([
                "slider_title" => $request->slider_title,
                "slider_subtitle" =>  $request->slider_subtitle,

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->route('all.slider')->with($notification);
        }
    }

    public function DeleteSlider($id)
    {
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink($img);

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }
}
