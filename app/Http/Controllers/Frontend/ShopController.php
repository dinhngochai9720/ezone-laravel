<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    //
    public function ShopPage()
    {
        $products = Product::query();
        // get products by category
        if (!empty($_GET['category'])) {
            $slugs = explode(',', $_GET['category']);
            $category_ids = Category::select('id')->whereIn('category_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('category_id',  $category_ids)->paginate(15);
        }
        // get products by brand
        elseif (!empty($_GET['brand'])) {
            $slugs = explode(',', $_GET['brand']);
            $brand_ids = Brand::select('id')->whereIn('brand_slug', $slugs)->pluck('id')->toArray();
            $products = Product::whereIn('brand_id',  $brand_ids)->paginate(15);
        }
        // get all product
        else {
            $products = Product::where('status', 1)->orderBy('created_at', 'DESC')->paginate(15);
        }

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $brands = Brand::orderBy('brand_name', 'ASC')->get();
        $new_products = Product::where('status', 1)->orderBy('created_at', 'DESC')->limit(3)->get();

        return view('frontend.product.shop_page', compact('products', 'categories', 'new_products', 'brands'));
    }

    public function ShopFilter(Request $request)
    {
        $data = $request->all();

        // Filter for category
        $category_url = '';
        if (!empty($data['category'])) {
            foreach ($data['category'] as $key => $category) {
                if (empty($category_url)) {
                    $category_url .= '&category=' . $category;
                } else {
                    $category_url .= ',' . $category;
                }
            }
        }

        // Filter for brand
        $brand_url = '';
        if (!empty($data['brand'])) {
            foreach ($data['brand'] as $key => $brand) {
                if (empty($brand_url)) {
                    $brand_url .= '&brand=' . $brand;
                } else {
                    $brand_url .= ',' . $brand;
                }
            }
        }

        return redirect()->route('shop.page', $category_url . $brand_url);
    }
}
