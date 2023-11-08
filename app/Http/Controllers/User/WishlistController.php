<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function AddToWishList(Request $request, $product_id)
    {
        if (Auth::check()) {
            // Check user logged in and product exists in wish list
            $exists = Wishlist::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            // product not exists in wish list
            if (!$exists) {
                Wishlist::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'success' => true,
                    'message' => 'Đã thêm sản phẩm'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Sản phẩm đã tồn tại'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Chưa đăng nhập'
            ]);
        }
    }

    public function AllWishList()
    {
        return view('frontend.wishlist.wishlist_product_view');
    }


    public function GetProductWishList()
    {
        // product is relationship in wishlist -> get data from products table
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->latest()->get();



        return response()->json($wishlist);
    }


    public function RemoveProductWishList($id)
    {

        // id product in wishlist table
        Wishlist::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }
}
