<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class UserController extends Controller
{
    //
    public function UserDashboard()
    {
        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.user.index', compact('userData'));
    }


    public function UseAccount()
    {

        $id = Auth::user()->id;
        $userData = User::find($id);
        return view('frontend.user.user_account_details', compact('userData'));
    }


    public function UserChangePassword()
    {
        return view('frontend.user.user_change_password');
    }

    public function UserUpdatePassword(Request $request)
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

            $notification = array(
                'message' => "Mật khẩu cũ không đúng",
                "alert-type" => "error"
            );
            return back()->with($notification);
        }

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

        $notification = array(
            'message' => "Đổi mật khẩu thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function UserUpdateProfile(Request $request)
    {
        $user_id = Auth::user()->id;
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

            User::findOrFail($user_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,
                'photo' =>  $save_url

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );
            return redirect()->back()->with($notification);
        } else {
            User::findOrFail($user_id)->update([
                "name" => $request->name,
                "fullname" => $request->fullname,
                "phone" => $request->phone,
                "address" => $request->address,

            ]);

            $notification = array(
                'message' => "Cập nhật thành công",
                "alert-type" => "success"
            );

            return redirect()->back()->with($notification);
        }
    }

    public function UserOrders(Request $request)
    {
        $id = Auth::user()->id;
        $orders = Order::where('user_id', $id)->orderBy('created_at', 'DESC')->paginate(7);
        return view('frontend.user.user_orders', compact('orders'));
    }


    // View Order
    public function UserOrderDetails($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::user()->id)->first();

        // get data product
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->orderBy('created_at', 'DESC')->get();

        return view('frontend.order.order_details', compact('order', 'order_items'));
    }


    // Print PDF
    public function UserOrderInvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->where('user_id', Auth::user()->id)->first();
        // get data product
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->orderBy('created_at', 'DESC')->get();

        // Laravel PDF
        $pdf = Pdf::loadView('frontend.order.order_invoice', compact('order_items', 'order'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function UserReturnOrder(Request $request, $order_id)
    {
        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,

        ]);

        $notification = array(
            'message' => "Đã yêu cầu hoàn lại đơn hàng",
            "alert-type" => "success"
        );


        return redirect()->route('user.orders.page')->with($notification);
    }

    public function UserReturnOrders()
    {
        $orders = Order::where('user_id', Auth::user()->id)->where('return_order', 1)->orWhere('return_order', 2)->orderBy('created_at', 'DESC')->get();

        return view('frontend.user.user_return_orders', compact('orders'));
    }

    public function UserTrackOrder()
    {
        return view('frontend.user.user_track_order');
    }

    public function UserCheckTrackingOrder(Request $request)
    {
        $invoice_code = $request->invoice_code;
        $order_tracking = Order::where('invoice_no', $invoice_code)->first();

        // Find order
        if ($order_tracking) {

            return view('frontend.order.order_tracking', compact('order_tracking'));
        }
        // Not found order
        else {

            $notification = array(
                'message' => "Mã hóa đơn không đúng",
                "alert-type" => "error"
            );


            return redirect()->back()->with($notification);
        }
    }


    public function UserLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => "Đã đăng xuất",
            "alert-type" => "success"
        );
        return redirect('/login')->with($notification);
    }
}
