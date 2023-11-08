<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //
    public function AllCoupon()
    {
        $coupons = Coupon::latest()->get();
        return view('backend.coupon.coupon_all', compact('coupons'));
    }

    public function AddCoupon()
    {
        return view('backend.coupon.coupon_add');
    }

    public function StoreCoupon(Request $request)
    {


        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            "coupon_discount" => $request->coupon_discount,
            "coupon_validity" => $request->coupon_validity,
            "created_at" => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.coupon')->with($notification);
    }

    public function EditCoupon($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    }

    public function UpdateCoupon(Request $request)
    {
        $coupon_id = $request->id;

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            "updated_at" => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );

        return redirect()->route('all.coupon')->with($notification);
    }


    public function DeleteCoupon($id)
    {

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Xóa thành công',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

  
}
