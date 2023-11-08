<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Image;

class VendorController extends Controller
{
    //
    public function VendorDashboard()
    {
        return view('vendor.index');
    }

    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    }

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.vendor_profile_view', compact('vendorData'));
    }

    public function VendorProfileUpdate(Request $request)
    {
        $vendor_id = Auth::user()->id;
        $old_image = $request->old_image;

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(144, 144)->save('upload/user_images/' . $name_gen);
            $save_url = 'upload/user_images/' . $name_gen;

            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            User::findOrFail($vendor_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,
                "vendor_join" => $request->vendor_join,
                "vendor_short_info" => $request->vendor_short_info,
                'photo' =>  $save_url

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);
        } else {
            User::findOrFail($vendor_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,
                "vendor_join" => $request->vendor_join,
                "vendor_short_info" => $request->vendor_short_info,

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );


            return redirect()->back()->with($notification);
        }
    }

    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    }


    public function VendorUpdatePassword(Request $request)
    {
        // Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ], [
            'old_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.confirmed' => 'Xác nhận mật khẩu chưa đúng! Vui lòng nhập lại',

        ]);

        // Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng');
        }

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }



    public function VendorDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => "Đã đăng xuất",
            "alert-type" => "success"
        );


        return redirect('/vendor/login')->with($notification);
    }

    // Become Vendor
    public function BecomeVendor()
    {
        return view('auth.become_vendor');
    }

    // Vendor Register
    public function VendorRegister(Request $request): RedirectResponse
    {

        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', 'min:8'],
            ],
            [
                'password.min' => 'Mật khẩu không đủ 8 ký tự',
                'password.confirmed' => 'Xác nhận mật khẩu không đúng'
            ]
        );

        $user = User::insert([
            'name' => $request->name,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',

        ]);

        $notification = array(
            'message' => "Đăng ký thành công",
            "alert-type" => "success"
        );


        return redirect()->route('vendor.login')->with($notification);
    }
}
