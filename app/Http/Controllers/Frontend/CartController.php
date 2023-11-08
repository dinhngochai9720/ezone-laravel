<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDistricts;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    // Add product to cart on quickview
    public function QuickViewAddToCart(Request $request, $id)
    {

        if (Session::has('coupon')) {
            // Delete Session
            Session::forget('coupon');
        };

        $product = Product::findOrFail($id);

        // No discount
        if ($product->selling_price == $product->discount_price && $product->product_qty >= $request->quantity) {
            Cart::add([
                'id' => $id,
                'name' => $request->name_product,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor_id' => $request->id_of_vendor,
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng'
            ]);
        }
        // Have discount
        elseif ($product->selling_price < $product->discount_price || $product->selling_price > $product->discount_price && $product->product_qty >= $request->quantity) {

            Cart::add([
                'id' => $id,
                'name' => $request->name_product,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor_id' => $request->id_of_vendor,
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vượt quá số lượng sản phẩm có sẵn'
            ]);
        }
    }


    // Add product to cart on product detail page
    public function ProductDetailsAddToCart(Request $request, $id)
    {

        if (Session::has('coupon')) {
            // Delete Session
            Session::forget('coupon');
        };


        $product = Product::findOrFail($id);

        // No discount
        if ($product->selling_price == $product->discount_price && $product->product_qty >= $request->quantity) {
            Cart::add([
                'id' => $id,
                'name' => $request->name_product,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor_id' => $request->id_of_vendor,
                ],
            ]);


            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng'
            ]);
        }
        // Have discount
        elseif ($product->selling_price < $product->discount_price || $product->selling_price > $product->discount_price && $product->product_qty >= $request->quantity) {
            Cart::add([
                'id' => $id,
                'name' => $request->name_product,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                    'vendor_id' => $request->id_of_vendor,
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Đã thêm sản phẩm vào giỏ hàng'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vượt quá số lượng sản phẩm có sẵn'
            ]);
        }
    }

    // Display minicart
    public function GetMiniCart()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = round(Cart::total());

        return response()->json(array(
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total
        ));
    }

    // Remove products from  mini cart
    public function RemoveProductFromMiniCart($rowId)
    {
        Cart::remove($rowId);

        if (Session::has('coupon')) {
            // Get the coupon name of Session
            $coupon_name = Session::get('coupon')['coupon_name'];

            // Check coupon name of Session == coupon_name in database
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            // Put new coupon
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round((Cart::total() - round(Cart::total() * $coupon->coupon_discount / 100))),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }

    public function MyCart()
    {
        return view('frontend.cart.cart_view');
    }

    // Display products on cart page
    public function GetProductCart()
    {
        $carts = Cart::content();
        $cart_qty = Cart::count();
        $cart_total = round(Cart::total());

        return response()->json(array(
            'carts' => $carts,
            'cart_qty' => $cart_qty,
            'cart_total' => $cart_total
        ));
    }

    // Remove products from cart page
    public function RemoveProductCart($rowId)
    {

        Cart::remove($rowId);

        if (Session::has('coupon')) {
            // Get the coupon name of Session
            $coupon_name = Session::get('coupon')['coupon_name'];

            // Check coupon name of Session == coupon_name in database
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            // Put new coupon
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round((Cart::total() - round(Cart::total() * $coupon->coupon_discount / 100))),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }

    // Decrease quantity product
    public function DecrementQuantityProductCart($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if (Session::has('coupon')) {
            // Get the coupon name of Session
            $coupon_name = Session::get('coupon')['coupon_name'];

            // Check coupon name of Session == coupon_name in database
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            // Put new coupon
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round((Cart::total() - round(Cart::total() * $coupon->coupon_discount / 100))),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã giảm số lượng sản phẩm'
        ]);
    }

    // Increase quantity product
    public function IncrementQuantityProductCart($rowId)
    {
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if (Session::has('coupon')) {
            // Get the coupon name of Session
            $coupon_name = Session::get('coupon')['coupon_name'];

            // Check coupon name of Session == coupon_name in database
            $coupon = Coupon::where('coupon_name', $coupon_name)->first();

            // Put new coupon
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round((Cart::total() - round(Cart::total() * $coupon->coupon_discount / 100))),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã tăng số lượng sản phẩm'
        ]);
    }

    // Apply coupon
    public function ApplyCoupon(Request $request)
    {
        // Check coupon entered === coupon_name in database and coupon_validity >= now() date
        $coupon = Coupon::where('coupon_name', $request->coupon_name)->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))->first();

        if ($coupon) {
            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round((Cart::total() - round(Cart::total() * $coupon->coupon_discount / 100))),
            ]);

            return response()->json([
                'validity' => true,
                'success' => true,
                'message' => 'Thêm coupon thành công'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Coupon không tồn tại'
            ]);
        }
    }

    // Update price after apply coupon
    public function CalculateCoupon()
    {
        // Apply the coupon
        if (Session::has('coupon')) {
            return response()->json(array(
                'subtotal' => round(Cart::total()),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }
        // Do not apply the coupon
        else {
            return response()->json([
                'total' => Cart::total(),
            ]);
        }
    }

    // Remove a coupon
    public function RemoveCoupon()
    {
        // Delete Session
        Session::forget('coupon');

        return response()->json([
            'success' => true,
            'message' => 'Xóa coupon thành công'
        ]);
    }

    public function CreateCheckout()
    {
        if (Auth::check()) {
            if (Cart::total() > 0) {
                $carts = Cart::content();
                $cart_qty = Cart::count();
                $cart_total = round(Cart::total());

                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                $districts = ShipDistricts::orderBy('district_name', 'DESC')->get();
                $states = ShipState::orderBy('state_name', 'DESC')->get();


                return  view('frontend.checkout.checkout_view', compact('carts', 'cart_qty', 'cart_total', 'divisions'));
            } else {
                $notification = array(
                    "alert-type" => "error",
                    'message' => "Giỏ hàng trống"
                );

                return redirect()->to('/')->with($notification);
            }
        } else {
            $notification = array(
                "alert-type" => "error",
                'message' => "Chưa đăng nhập"
            );

            return redirect()->route('login')->with($notification);
        }
    }
}
