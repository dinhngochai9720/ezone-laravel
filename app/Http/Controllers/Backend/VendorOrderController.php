<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendorOrderController extends Controller
{
    //
    public function VendorAllOrder()
    {
        $id = Auth::user()->id; //id of vendor logged in
        $order_items = OrderItem::where('vendor_id', $id)->orderBy('created_at', 'DESC')->get();

        // order_items duplicate -> get only 1 order_item if duplicate
        $order_items_unique = $order_items->unique(['order_id']);
        // get order items duplicates
        $order_item_duplicates = $order_items->diff($order_items_unique);

        // https://laravel.com/docs/8.x/collections#method-diff
        $collection = $order_items;
        // find different order_items between $order_items
        $diff_order_items = $collection->diff($order_item_duplicates);
        $diff_order_items->all();
        // dd($diff_order_items);

        return view('vendor.backend.order.vendor_order_all', compact('diff_order_items'));
    }

    public function VendorOrderDetails($order_id)
    {
        $id = Auth::user()->id; //id of vendor logged in

        $order = Order::with('division', 'district', 'state', 'user')->where('id', $order_id)->first();

        // get data product
        $order_items = OrderItem::with('product')->where('vendor_id', $id)->where('order_id', $order_id)->orderBy('created_at', 'DESC')->get();

        return view('vendor.backend.order.vendor_order_details', compact('order', 'order_items'));
    }

    public function VendorReturnOrders()
    {

        $id = Auth::user()->id; //id of vendor logged in
        // order is relationship in OrderItem Model
        $order_items = OrderItem::with('order')->where('vendor_id', $id)->orderBy('created_at', 'DESC')->get();

        // order_items duplicate -> get only 1 order_item if duplicate
        $order_items_unique = $order_items->unique(['order_id']);
        $order_item_duplicates = $order_items->diff($order_items_unique);

        // https://laravel.com/docs/8.x/collections#method-diff
        $collection = $order_items;
        $diff_order_items = $collection->diff($order_item_duplicates);
        $diff_order_items->all();

        return view('vendor.backend.order.vendor_return_orders', compact('diff_order_items'));
    }

    public function VendorCompleteReturnOrders()
    {

        $id = Auth::user()->id; //id of vendor logged in
        // order is relationship in OrderItem Model
        $order_items = OrderItem::with('order')->where('vendor_id', $id)->orderBy('created_at', 'DESC')->get();

        // order_items duplicate -> get only 1 order_item if duplicate
        $order_items_unique = $order_items->unique(['order_id']);
        $order_item_duplicates = $order_items->diff($order_items_unique);

        // https://laravel.com/docs/8.x/collections#method-diff
        $collection = $order_items;
        $diff_order_items = $collection->diff($order_item_duplicates);
        $diff_order_items->all();

        return view('vendor.backend.order.vendor_complete_return_orders', compact('diff_order_items'));
    }
}
