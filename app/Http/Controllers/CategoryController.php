<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Brian2694\Toastr\Facades\Toastr;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\ViewServiceProvider;

class CategoryController extends Controller
{
    public function getCategory()
    {
        $category = Category::paginate(10);
        $num = 1;
        return view('category.category-list', compact('category', 'num'));
    }

    public function addCategory()
    {
        $data = Category::where(['parent_category_id' => 0])->get();
        // echo '<pre>';
        // print_r($data);
        // die();
        // foreach ($data as $item) {
        //     echo $item->cname . '<br>';
        //     $sub = Category::where(['parent_category_id' => $item->cid])->get();
        //     foreach ($sub as $cat) {
        //         echo $cat->cname . '<br><br>';
        //     }
        // }

        return view('category.add-category', compact('data'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'cname' => 'required|unique:categories,cname',
            'slug' => 'required|unique:categories,slug',
            'file' => 'mimes:png,jpg,jpeg',
        ], [
            'cname.required' => '**Category Name is Required',
            'cname.unique' => '**Category already exits',
            'slug.required' => '**Category Name is Required',
            'slug.unique' => '**Category already exits',

        ]);

        $name = $request->cname;
        $slug = $request->slug;
        $parent_category_id = $request->parent_category_id;
        $imageName = '';
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('category_images'), $imageName);
        } else {
            $imageName = '';
        }
        $category = new Category();
        $category->cname = $name;
        $category->slug = $slug;
        $category->parent_category_id = $parent_category_id;
        $category->category_image = $imageName;
        $category->save();
        Toastr::success('Category added successfully :)', 'Success');
        return redirect('/admin/category-list');
    }

    public function deleteCategory($cid)
    {
        $category = Category::find($cid);
        $category->delete();
        Toastr::error('Category Deleted Successfully');
        return back();
    }

    public function editCategory($id)
    {
        $category = Category::find($id);
        //$parent_category = Category::where('cid', '!=', $id)->get();
        $parent_category = Category::with('categories')->where(['parent_category_id' => 0])->get();
        //$result['category'] = DB::table('categories')->where('cid', '=', $id)->get();
        //$result['parent_category'] = DB::table('categories')->select('parent_category_id')->where('cid', '!=', $id)->get();
        //echo '<pre>';
        // print_r($category[0]->parent_category_id);
        //print_r($category);
        //die();
        return view('category.edit-category', compact('category', 'parent_category'));
    }

    public function updateCategory(Request $request)
    {

        $cname = $request->cname;
        $slug = $request->slug;
        $parent_category_id = $request->parent_category_id;
        $imageName = '';
        $image = $request->file('file');
        if ($image == null) {
            $category = Category::find($request->cid);
            $imageName = $category->category_image;
        } else {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('category_images'), $imageName);
        }
        // echo '<pre>';
        // print_r(json_decode(json_encode($imageName)));
        // die();

        #$id = $request->cid;
        $category = Category::find($request->cid);
        $category->cname = $cname;
        $category->slug = $slug;
        $category->parent_category_id = $parent_category_id;
        $category->category_image = $imageName;
        $category->save();
        Toastr::success('Category Updated Successfully');
        return redirect('/admin/category-list');
    }
}