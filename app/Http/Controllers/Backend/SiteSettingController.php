<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\Seo;
use Illuminate\Http\Request;
use Image;
use Carbon\Carbon;

class SiteSettingController extends Controller
{
    //
    public function AdminSiteSetting()
    {
        $setting = SiteSetting::find(1);

        return view('backend.site_setting.site_setting_update', compact('setting'));
    }

    public function AdminSiteSettingUpdate(Request $request)
    {
        $site_setting_id = $request->id;
        $old_image = $request->old_image;

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(180, 56)->save('upload/logo/' . $name_gen);
            $save_url = 'upload/logo/' . $name_gen;

            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }


            SiteSetting::findOrFail($site_setting_id)->update([
                "support_phone" => $request->support_phone,
                "phone_one" => $request->phone_one,
                "email" => $request->email,
                "company_address" => $request->company_address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,
                "copyright" => $request->copyright,
                "logo" => $save_url,
                "updated_at" => Carbon::now(),

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->back()->with($notification);
        } else {

            SiteSetting::findOrFail($site_setting_id)->update([
                "support_phone" => $request->support_phone,
                "phone_one" => $request->phone_one,
                "email" => $request->email,
                "company_address" => $request->company_address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,
                "copyright" => $request->copyright,
                "updated_at" => Carbon::now(),

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->back()->with($notification);
        }
    }

    public function AdminSeoSetting()
    {
        $seo = Seo::find(1);

        return view('backend.seo.seo_update', compact('seo'));
    }

    public function AdminSeoSettingUpdate(Request $request)
    {
        $seo_setting_id = $request->id;

        Seo::findOrFail($seo_setting_id)->update([
            "meta_title" => $request->meta_title,
            "meta_author" => $request->meta_author,
            "meta_keyword" => $request->meta_keyword,
            "meta_description" => $request->meta_description,
            "updated_at" => Carbon::now(),

        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }
}
