<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function Index()
    {
        $skip_category_0 = Category::skip(0)->first(); //skip category 0, get category first in database 
        $skip_products_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('created_at', 'DESC')->limit(5)->get(); // get products have category_id = $skip_category_0->id


        $skip_category_1 = Category::skip(1)->first(); //skip category 1, get category second in database 
        $skip_products_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('created_at', 'DESC')->limit(5)->get();

        $skip_category_2 = Category::skip(2)->first(); //skip category 3, get category fourth in database 
        $skip_products_2 = Product::where('status', 1)->where('category_id', $skip_category_2->id)->orderBy('created_at', 'DESC')->limit(5)->get();

        $hot_deals = Product::where('status', 1)->where('hot_deals', 1)->where('discount_price', '!=', NULL)->where('discount_price', '!=', 0)->orderBy('created_at', 'DESC')->limit(3)->get();


        $special_offer = Product::where('status', 1)->where('special_offer', 1)->where('discount_price', '!=', NULL)->where('discount_price', '!=', 0)->orderBy('created_at', 'DESC')->limit(3)->get();

        $special_deals = Product::where('status', 1)->where('special_deals', 1)->where('discount_price', '!=', NULL)->where('discount_price', '!=', 0)->orderBy('created_at', 'DESC')->limit(3)->get();

        $recently_added = Product::where('status', 1)->where('discount_price', '!=', NULL)->where('discount_price', '!=', 0)->orderBy('created_at', 'DESC')->limit(3)->get();


        return view('frontend.index', compact('skip_products_0', 'skip_category_0', 'skip_category_1', 'skip_products_1', 'skip_category_2', 'skip_products_2', 'hot_deals', 'special_offer', 'special_deals', 'recently_added'));
    }

    //
    public function ProductDetails($id, $slug)
    {

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color); // convert string to array


        $size = $product->product_size;
        $product_size = explode(',', $size); // convert string to array

        $multiImage = MultiImage::where('product_id', $id)->get();

        $cat_id = $product->category_id;
        $related_products = Product::where('category_id', $cat_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(4)->get();


        return view('frontend.product.product_details', compact('product', 'product_color', 'product_size', 'multiImage', 'related_products'));
    }

    public function VendorDetails($id)
    {
        $vendor = User::findOrFail($id);
        $products_vendor = Product::where('vendor_id', $id)->get();

        return view('frontend.vendor.vendor_details', compact('products_vendor', 'vendor'));
    }

    public function VendorAll()
    {
        $vendors = User::where('status', 'active')->where('role', 'vendor')->orderBy('created_at', 'DESC')->get();
        return view('frontend.vendor.vendor_all', compact('vendors'));
    }


    public function GetProductOfCategory(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('category_id', $id)->orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->limit(5)->get();
        $category_name = Category::where('id', $id)->first();
        $new_products = Product::where('status', 1)->orderBy('created_at', 'DESC')->limit(3)->get();

        return view('frontend.product.product_category_view', compact('products', 'categories', 'category_name', 'new_products'));
    }

    public function GetProductOfSubCategory(Request $request, $id, $slug)
    {
        $products = Product::where('status', 1)->where('subcategory_id', $id)->orderBy('created_at', 'DESC')->get();
        $categories = Category::orderBy('created_at', 'DESC')->limit(8)->get();

        $subcategory_name = SubCategory::where('id', $id)->first();

        $new_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();

        return view('frontend.product.product_subcategory_view', compact('products', 'categories', 'subcategory_name', 'new_products'));
    }

    public function ProductViewModalAjax($id)
    {
        // 'category','band' is relationship in Product Model
        $product = Product::with('category', 'brand', 'vendor')->findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',', $color); // convert string to array


        $size = $product->product_size;
        $product_size = explode(',', $size); // convert string to array

        return response()->json(array(

            'product' => $product,
            'color' => $product_color,
            'size' => $product_size,
        ));
    }

    public function ProductSearch(Request $request)
    {
        $request->validate([
            'search' => 'required',
        ]);

        $item = $request->search;

        $new_products = Product::orderBy('created_at', 'DESC')->limit(3)->get();

        $categories = Category::orderBy('created_at', 'DESC')->get();

        $products = Product::where('product_name', 'LIKE', "%$item%")->get();

        return view('frontend.product.product_search', compact('products', 'item', 'categories', 'new_products'));
    }

    public function ProductSearchAdvanced(Request $request)
    {
        $request->validate([
            'search_advanced' => 'required',
        ]);

        // search_advanced in script.js
        $item = $request->search_advanced;

        $products = Product::where('product_name', 'LIKE', "%$item%")->select('product_name', 'product_slug', 'product_thumbnail', 'selling_price', 'id')->limit(6)->get();

        return view('frontend.product.product_search_advanced', compact('products'));
    }
}
