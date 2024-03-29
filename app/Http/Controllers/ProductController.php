<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DelivaryAddress;
use App\Models\FrontUser;
use App\Models\Order;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function getProduct()
    {
        $products = Category::join('products', 'products.pcategory', '=', 'categories.cid')->orderby('pid', 'DESC')->paginate(10);
        return view('products.product-list', compact('products'));
    }

    public function addProduct()
    {
        $category = Category::with('categories')->where(['parent_category_id' => 0])->get();
        //$category = Category::all();
        return view('products.add-product',  compact('category'));
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'pname' => 'required|unique:products,pname',
            'pprice' => 'required|integer',
            'pstock' => 'required|integer',
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

        $product_code = rand(111111, 999999);
        $pname = $request->pname;
        $pprice = $request->pprice;
        $pstock = $request->pstock;
        $pcategory = $request->pcategory;
        $description = $request->description;
        $care = $request->care;

        $image = $request->file('file');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('product_images'), $imageName);

        $product = new Product();
        $product->product_code = $product_code;
        $product->pname = $pname;
        $product->pimage = $imageName;
        $product->pprice = $pprice;
        $product->pstock = $pstock;
        $product->pcategory = $pcategory;
        $product->description = $description;
        $product->care = $care;
        $product->save();
        Toastr::success('Product Added Successfully!!');
        return redirect('admin/product-list');
    }

    public function editProduct($id)
    {
        $products = Product::find($id);
        $category = Category::with('categories')->where(['parent_category_id' => 0])->get();
        #$products = Product::join('categories', 'products.pcategory', '=', 'categories.cid')->find($id);
        return view('products.edit-product', compact('products', 'category'));
    }

    public function updateProduct(Request $request)
    {
        $pname = $request->pname;
        $pprice = $request->pprice;
        $pstock = $request->pstock;
        $pcategory = $request->pcategory;
        $description = $request->description;
        $care = $request->care;

        $image = $request->file('file');
        if ($image != null) {
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('product_images'), $imageName);
        } else {
            $product1 = Product::find($request->pid);
            $imageName = $product1->pimage;
        }


        $product = Product::find($request->pid);
        $product->pname = $pname;
        $product->pimage = $imageName;
        $product->pprice = $pprice;
        $product->pstock = $pstock;
        $product->pcategory = $pcategory;
        $product->description = $description;
        $product->care = $care;
        $product->save();
        Toastr::success('Product Updated Successfully');
        return redirect()->route('product.fetch');
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        unlink(public_path('product_images') . '/' . $product->pimage);
        $product->delete();
        Toastr::error('Product Deleted Successfully');
        return back();
    }

    public function viewOrder()
    {
        $orders = Order::with('orders')->orderBy('id', 'DESC')->paginate(5);
        // echo '<pre>';
        // print_r(json_decode((json_encode($orders))));
        // die();
        return view('products.view_order', compact('orders'));
    }

    public function orderDetail($id)
    {
        $order = Order::with('orders')->where('id', $id)->first();
        $user_id = $order->user_id;
        $total_product_buy = 0;
        foreach ($order->orders as $item) {
            $total_product_buy++;
        }
        // $userDetails = FrontUser::where('id', $id)->first();
        $shippingDetail = DelivaryAddress::where('user_id', $user_id)->first();
        // echo '<pre>';
        // print_r(json_decode((json_encode($total_product_buy))));
        // die();
        return view('products.order_details', compact('order', 'shippingDetail', 'total_product_buy'));
    }

    public function orderStatusUpdate(Request $request)
    {
        Order::where(['id' => $request->order_id])->update(['order_status' => $request->order_status]);
        $data = Order::where(['id' => $request->order_id])->first();
        // echo '<pre>';
        // print_r(json_decode((json_encode($data))));
        // die();
        $email = $data->user_email;
        $messageData = [
            'email' => $email,
            'name' => $data->name,
            'order_id' => $request->order_id,
            'order_status' => $data->order_status,
        ];
        Mail::send('emails.order_status', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Order Status Update- E-shopper Website');
        });
        Toastr::success('Order status update successfully!!', 'Success');
        return back();
    }

    public function orderInvoice($id)
    {
        $order = Order::with('orders')->where('id', $id)->first();
        $user_id = $order->user_id;
        $shippingDetail = DelivaryAddress::where('user_id', $user_id)->first();
        // echo '<pre>';
        // print_r(json_decode((json_encode($order))));
        // die();
        return view('products.order_invoice', compact('order', 'shippingDetail'));
    }
}