<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    //
    public function AllSubCategory()
    {
        $subcategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subcategories'));
    }

    public function AddSubcategory()
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }

    public function StoreSubcategory(Request $request)
    {


        SubCategory::insert([
            "category_id" => $request->category_id,
            "subcategory_name" => $request->subcategory_name,
            "subcategory_slug" => strtolower(str_replace(' ', '-', $request->subcategory_name)),

        ]);

        $notification = array(
            'message' => "Thêm thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.subcategory')->with($notification);
    }

    public function EditSubcategory($id)
    {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subcategory'));
    }

    public function UpdateSubcategory(Request $request)
    {
        $sub_id = $request->id;

        SubCategory::findOrFail($sub_id)->update([
            "category_id" => $request->category_id,
            "subcategory_name" => $request->subcategory_name,
            "subcategory_slug" => strtolower(str_replace(' ', '-', $request->subcategory_name)),

        ]);

        $notification = array(
            'message' => "Cập nhật thành công",
            "alert-type" => "success"
        );


        return redirect()->route('all.subcategory')->with($notification);
    }


    public function DeleteSubcategory($id)
    {


        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => "Xóa thành công",
            "alert-type" => "success"
        );


        return redirect()->back()->with($notification);
    }
}
