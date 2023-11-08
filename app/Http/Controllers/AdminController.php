<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Image;

class AdminController extends Controller
{
    //
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }


    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $admin_id = Auth::user()->id;
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

            User::findOrFail($admin_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,
                'photo' =>  $save_url

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);
        } else {
            User::findOrFail($admin_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,
                "facebook" => $request->facebook,
                "youtube" => $request->youtube,
                "instagram" => $request->instagram,

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
    }

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    }


    public function AdminUpdatePassword(Request $request)
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
        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng');
        }

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        return back()->with('success', 'Đổi mật khẩu thành công');
    }

    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => "Đã đăng xuất",
            "alert-type" => "success"
        );


        return redirect('/admin/login')->with($notification);
    }

    public function InactiveVendor()
    {
        $inActiveVendors = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.inactive_vendor', compact('inActiveVendors'));
    }

    public function InactiveVendorDetails($id)
    {
        $inActiveVendorDetails = User::findOrFail($id);

        return view('backend.vendor.inactive_vendor_details', compact('inActiveVendorDetails'));
    }

    public function ActiveVendor()
    {
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.active_vendor', compact('activeVendors'));
    }

    public function ActiveVendorDetails($id)
    {
        $activeVendorDetails = User::findOrFail($id);

        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }


    public function ActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update(['status' => 'active']);


        $notification = array(
            'message' => "Cho phép nhà cung cấp hoạt động",
            "alert-type" => "success"
        );


        return redirect()->route('active.vendor')->with($notification);
    }

    public function InActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update(['status' => 'inactive']);


        $notification = array(
            'message' => "Không cho phép nhà cung cấp hoạt động ",
            "alert-type" => "success"
        );


        return redirect()->route('inactive.vendor')->with($notification);
    }
}
