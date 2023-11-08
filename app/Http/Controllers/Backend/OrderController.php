<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class OrderController extends Controller
{
    //
    public function AdminPendingOrder()
    {
        $orders = Order::where('status', 'pending')->orderBy('created_at', 'DESC')->get();

        return view('backend.orders.pending_orders', compact('orders'));
    }

    public function AdminConfirmedOrder()
    {
        $orders = Order::where('status', 'confirmed')->orderBy('created_at', 'DESC')->get();

        return view('backend.orders.confirmed_orders', compact('orders'));
    }

    public function AdminProcessingOrder()
    {
        $orders = Order::where('status', 'processing')->orderBy('created_at', 'DESC')->get();

        return view('backend.orders.processing_orders', compact('orders'));
    }

    public function AdminDeliveredOrder()
    {
        $orders = Order::where('status', 'delivered')->orderBy('created_at', 'DESC')->get();

        return view('backend.orders.delivered_orders', compact('orders'));
    }

    public function AdminOrderDetails($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();

        // get data product
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->orderBy('created_at', 'DESC')->get();

        return view('backend.orders.admin_order_details', compact('order', 'order_items'));
    }

    public function AdminPendingToConfirmedOrder($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'confirmed']);

        $notification = array(
            'message' => "Đã xác nhận",
            "alert-type" => "success"
        );

        return redirect()->back()->with($notification);
    }

    public function AdminConfirmedToProcessingOrder($order_id)
    {
        Order::findOrFail($order_id)->update(['status' => 'processing'],);

        $notification = array(
            'message' => "Đang xử lý",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }


    public function AdminProcessingToDeliveredOrder($order_id)
    {
        // Update quantity product after delivery
        $products = OrderItem::where('order_id', $order_id)->get();
        foreach ($products as $product) {
            Product::where('id', $product->product_id)->update([
                'product_qty' => DB::raw('product_qty-' . $product->qty)
            ]);
        }

        Order::findOrFail($order_id)->update(['status' => 'delivered']);

        $notification = array(
            'message' => "Đã giao hàng",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    // Print PDF
    public function AdminInvoiceDownload($order_id)
    {
        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();

        // get data product
        $order_items = OrderItem::with('product')->where('order_id', $order_id)->orderBy('created_at', 'DESC')->get();

        // Laravel PDF
        $pdf = Pdf::loadView('backend.orders.admin_order_invoice', compact('order_items', 'order'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    // All Return Order
    public function AdminReturnRequestOrders()
    {
        $orders = Order::where('return_order', 1)->orderBy('created_at', 'DESC')->get();

        return view('backend.return_order.return_request_orders', compact('orders'));
    }

    // Approve Return Request Order
    public function AdminApproveReturnRequestOrder($order_id)
    {
        Order::where('id', $order_id)->update([
            'return_order' => 2,
        ]);

        $notification = array(
            'message' => "Chấp nhận yêu cầu hoàn lại đơn hàng",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    // All Complete Return Request Order
    public function AdminCompleteReturnRequestOrders()
    {
        $orders = Order::where('return_order', 2)->orderBy('created_at', 'DESC')->get();

        return view('backend.return_order.complete_return_request_orders', compact('orders'));
    }
}
