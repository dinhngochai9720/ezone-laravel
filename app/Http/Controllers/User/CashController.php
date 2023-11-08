<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CashController extends Controller
{
    //
    public function CashOrder(Request $request)
    {

        if (Session::has('coupon')) {
            //Get price after apply coupon
            $subtotal = round(Cart::total());
            $discount_coupon = Session::get('coupon')['discount_amount'];
            $total_amount = Session::get('coupon')['total_amount']; //price after coupon
        } else {
            $subtotal = round(Cart::total());
            $discount_coupon = 0;
            $total_amount = round(Cart::total());
        }

        $order_id = Order::insertGetId([
            'user_id' => Auth::id(),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,


            'payment_type' => 'Thanh toán khi nhận hàng',
            'payment_method' => 'Thanh toán khi nhận hàng',
            'currency' =>  'VNĐ',
            'amount' =>  $total_amount,
            'subtotal' =>  $subtotal,
            'discount_coupon' =>  $discount_coupon,

            'invoice_no' => mt_rand(10000000, 99999999), //random number

            'order_date' => Carbon::now()->format('d F Y'),
            'order_month' => Carbon::now()->format('F'),
            'order_year' => Carbon::now()->format('Y'),

            'status' => 'pending',
            'created_at' =>  Carbon::now()
        ]);

        $carts = Cart::content();

        // Insert Products for order items table
        foreach ($carts as $item) {
            OrderItem::insert([
                'order_id' => $order_id, //id of order
                'product_id' => $item->id, //id is id of product, rowId !== id
                'vendor_id' => $item->options->vendor_id,
                'color' =>  $item->options->color,
                'size' => $item->options->size,
                'qty' =>  $item->qty,
                'price' => $item->price,
                'created_at' =>  Carbon::now(),
            ]);
        }

        // Remove coupon after order successfully
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        // Remove product after order successfully
        Cart::destroy();


        $notification = array(
            'message' => "Đặt hàng thành công",
            "alert-type" => "success"
        );

        return redirect()->route('dashboard')->with($notification);
    }
}
