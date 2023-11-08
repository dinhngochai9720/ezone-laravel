<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    //
    public function AddToCompare(Request $request, $product_id)
    {
        if (Auth::check()) {
            // Check user logged in and product exists in wish list
            $exists = Compare::where('user_id', Auth::id())->where('product_id', $product_id)->first();

            // product not exists in wish list
            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json([
                    'success' => true,
                    'message'  => 'Đã thêm sản phẩm'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message'  => 'Sản phẩm đã tồn tại'
                ]);
            }
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Chưa đăng nhập'
            ]);
        }
    }

    public function AllCompare()
    {
        return view('frontend.compare.compare_product_view');
    }

    public function GetProductCompare()
    {
        // product is relationship in compare -> get data from products table
        $compare = Compare::with('product')->where('user_id', Auth::id())->latest()->get();


        return response()->json($compare);
    }

    public function RemoveProductCompare($id)
    {

        // id product in wishlist table
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xóa sản phẩm thành công'
        ]);
    }
}
