<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProduct()
    {
        $products = Category::join('products', 'products.pcategory', '=', 'categories.cid')->get();
        return view('products.product-list', compact('products'));
    }

    public function addProduct()
    {
        $category = Category::all();
        return view('products.add-product',  compact('category'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'pname' => 'required|unique:products,pname',
            'pprice' => 'required|integer',
            'pcategory' => 'required|integer',
            'file' => 'required',
        ], [
            'pname.required' => '**Product Name is Required',
            'pname.unique' => '**Product name already exist',
            'pprice.required' => '**Product Price is Required',
            'pprice.integer' => '**Price must be number',
            'pcategory.required' => '**Select any one Category',
            'file.required' => '**Image is Required'
        ]);

        $pname = $request->pname;
        $pprice = $request->pprice;
        $pcategory = $request->pcategory;

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('product_images'), $imageName);

        $product = new Product();
        $product->pname = $pname;
        $product->pimage = $imageName;
        $product->pprice = $pprice;
        $product->pcategory = $pcategory;
        $product->save();

        return back()->with('product_added', 'Product Added Successfully!!!');
    }

    public function editProduct($id)
    {
        $products = Product::find($id);
        $category = Category::all();
        #$products = Product::join('categories', 'products.pcategory', '=', 'categories.cid')->find($id);
        return view('products.edit-product', compact('products', 'category'));
    }

    public function updateProduct(Request $request)
    {
        $pname = $request->pname;
        $pprice = $request->pprice;
        $pcategory = $request->pcategory;

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('product_images'), $imageName);

        $product = Product::find($request->pid);
        $product->pname = $pname;
        $product->pimage = $imageName;
        $product->pprice = $pprice;
        $product->pcategory = $pcategory;
        $product->save();
        return redirect()->route('product.fetch');
        return back()->with('product_update', 'Product Updated Successfully!!');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        unlink(public_path('product_images') . '/' . $product->pimage);
        $product->delete();
        return back()->with('product_deleted', 'Product Deleted Successfully!!');
    }
}