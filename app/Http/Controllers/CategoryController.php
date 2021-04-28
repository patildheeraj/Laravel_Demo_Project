<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\View\ViewServiceProvider;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $category = Category::all();
        $num = 1;
        return view('category.category-list', compact('category', 'num'));
    }

    public function addCategory()
    {
        return view('category.add-category');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'cname' => 'required|unique:categories,cname',
        ], [
            'cname.required' => '**Category Name is Required',
            'cname.unique' => '**Category already exits',
        ]);

        $name = $request->cname;

        $category = new Category();
        $category->cname = $name;
        $category->save();
        return back()->with('category_added', 'Category added successfully!!');
    }

    public function deleteCategory($cid)
    {
        $category = Category::find($cid);
        $category->delete();
        return back()->with('category_deleted', 'Category Deleted Successfully');
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        return view('category.edit-category', compact('category'));
    }

    public function updateCategory(Request $request)
    {
        $cname = $request->cname;
        #$id = $request->cid;
        $category = Category::find($request->cid);
        $category->cname = $cname;
        $category->save();
        return back()->with("category_updated", 'Category Updated Successfully!!');
    }
}