<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    //
    public function AllProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }
    public function AddProduct()
    {
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->orWhere('role', 'admin')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendors'));
    }
    public function StoreProduct(Request $request)
    {


        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);
        $save_url = 'upload/products/thumbnail/' . $name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,

            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'product_thumbnail' => $save_url,


            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        // Multiple image upload from here
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            // Insert to multi_images table
            MultiImage::insert([
                'product_id' => $product_id, //get id of product
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id)
    {
        $activeVendors = User::where('status', 'active')->where('role', 'vendor')->orWhere('role', 'admin')->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $product = Product::findOrFail($id);
        $multiImgs = MultiImage::where('product_id', $id)->get();
        return view('backend.product.product_edit', compact('brands', 'categories', 'subcategories', 'activeVendors', 'product', 'multiImgs'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;


        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'vendor_id' => $request->vendor_id,

            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,

            'product_color' => $request->product_color,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,


            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'updated_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.product')->with($notification);
    }

    public function UpdateProductMainImageThumbnail(Request $request)
    {
        $product_id = $request->id;
        $old_image = $request->old_main_image_thumbnail;


        $image = $request->file('product_thumbnail');
        if (!empty($image)) {
            //Delete old image
            if (file_exists($old_image)) {
                unlink($old_image);
            }

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $name_gen);
            $save_url = 'upload/products/thumbnail/' . $name_gen;
        } else {
            $save_url =  $old_image;
        }




        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }


    public function UpdateProductMultiImage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {

            // Delete image exists in database and folder after add new image
            $deleteImg = MultiImage::findOrFail($id);
            unlink($deleteImg->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now()
            ]);
        }

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function DeleteProductMultiImage($id)
    {
        $oldImage =  MultiImage::findOrFail($id);
        unlink($oldImage->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function AddProductMultiImage($id)
    {

        $product_id = $id;
        return view('backend.product.product_add_multi_image', compact('product_id'));
    }

    public function StoreProductMultiImage(Request $request)
    {
        // Multiple Image Upload From Here

        $product_id = $request->id;


        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension(); //Ex: 232323.jpg
            Image::make($img)->resize(800, 800)->save('upload/products/multi-image/' . $make_name);
            $uploadPath = 'upload/products/multi-image/' . $make_name;

            // Insert to multi_images table
            MultiImage::insert([
                'product_id' => $product_id, //get id of product
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.product')->with($notification);
    }


    public function InActiveProduct($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message' => "Ẩn sản phẩm",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function ActiveProduct($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message' => "Hiển thị sản phẩm",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Delete the main image in folder
        unlink($product->product_thumbnail);

        Product::findOrFail($id)->delete();

        $images = MultiImage::where('product_id', $id)->get();
        foreach ($images as  $image) {
            // Delete the multi image in folder
            unlink($image->photo_name);

            MultiImage::where('product_id', $id)->delete();
        }

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }

    public function GetSubcategory($category_id)
    {
        $subcategories = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcategories);
    }

    public function AdminStockProduct()
    {
        $products =  Product::where('product_qty', '>', 0)->latest()->get();

        return view('backend.product.product_stock', compact('products'));
    }

    public function AdminOutStockProduct()
    {
        $products =  Product::where('product_qty', '=', 0)->latest()->get();


        return view('backend.product.product_out_stock', compact('products'));
    }
}
