<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    //Front-end
    public function StoreReview(Request $request)
    {
        $product_id = $request->product_id;
        $vendor_id = $request->rv_vendor_id;

        $request->validate(
            [
                'comment' => 'required',
            ],
        );

        Review::insert([
            'product_id' => $product_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'rating' => $request->quality,
            'vendor_id' => $vendor_id,
            "created_at" => Carbon::now(),
        ]);

        $notification = array(
            'message' => "Đánh giá sẽ được phê duyệt bởi quản trị viên",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    // Admin Backend
    public function AdminPendingReview()
    {
        $reviews = Review::where('status', 0)->orderBy('created_at', 'DESC')->get();
        return view('backend.review.pending_review', compact('reviews'));
    }

    public function AdminApproveReview($id)
    {
        Review::where('id', $id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => "Phê duyệt đánh giá thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function AdminPublishReview()
    {
        $reviews = Review::where('status', 1)->orderBy('created_at', 'DESC')->get();
        return view('backend.review.publish_review', compact('reviews'));
    }

    public function AdminDeleteReview($id)
    {
        Review::findOrFail($id)->delete();
        $notification = array(
            'message' => "Xóa đánh giá thành công",
            "alert-type" => "success"
        );
        return redirect()->route('admin.publish.review')->with($notification);
    }

    // Backend Vendor
    public function VendorAllReview()
    {
        $vendor_id = Auth::user()->id;

        $reviews = Review::where('vendor_id', $vendor_id)->where('status', 1)->orderBy('created_at', 'DESC')->get();

        return view('vendor.backend.review.review_all', compact('reviews'));
    }
}
