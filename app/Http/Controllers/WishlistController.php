<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    public function addToWishlist(Request $request, $pid)
    {
        $login = Session::get('FRONT_LOGIN');
        if (empty($login)) {
            return redirect('login')->with("fail", 'You must be login first');
        } else {
            $data = Product::where('pid', $pid)->first();
            $user_email = Session::get('FRONT_Email');
            $product_code = $data->product_code;
            $countProduct = DB::table('wishlists')->where(['product_id' => $pid,])->count();
            if ($countProduct == 1) {
                return back()->with('success', 'Item already exist in Wishlist!!');
            } elseif ($data->pstock < $request->quantity) {
                return back()->with('fail', 'only ' . $data->pstock . ' product stock is available');
            } else {

                $cart = new Wishlist();

                $cart->product_id = $pid;
                $cart->product_code = $product_code;
                $cart->product_name = $data->pname;
                $cart->product_price = $data->pprice;
                $cart->product_image = $data->pimage;
                $cart->user_email = $user_email;
                $cart->quantity = 1;
                $cart->save();
                //DB::table('products')->where('pid', $request->product_id)->decrement('pstock', $request->quantity);
                return redirect('/wishlist')->with('success', 'Item added in cart successfully!!');
            }
        }
    }

    public function viewWishlist()
    {
        $login = Session::get('FRONT_LOGIN');
        if (empty($login)) {
            return redirect('login')->with("fail", 'You must be login first');
        } else {

            $user_email = Session::get('FRONT_Email');
            if (empty($user_email)) {
                $list = '';
                return view('front_end.wishlist', compact('list'));
            } else {
                $list = Wishlist::where('user_email', $user_email)->get();
                // echo '<pre>';
                // print_r(json_decode(json_encode($list)));
                // die();
                return view('front_end.wishlist', compact('list'));
            }
        }
    }

    public function deleteWishlistItem($product_id)
    {
        DB::table('wishlists')->where(['product_id' => $product_id])->delete();
        return back()->with('success', 'Item deleted successfully!!');
    }

    public function updateWishlistQuantity($product_id, $quantity)
    {
        $cartDetail = DB::table('wishlists')->where('product_id', $product_id)->first();
        $product = DB::table('products')->where('product_code', $cartDetail->product_code)->first();
        $updatedQuantity = ($cartDetail->quantity) + ($quantity);
        // echo $updatedQuantity;
        // die();
        if ($product->pstock >= $updatedQuantity) {
            DB::table('wishlists')->where('product_id', $product_id)->increment('quantity', $quantity);
            return back()->with('success', 'Item quantity has been increases successfully!!');
        } else {
            return back()->with('fail', 'sufficient stock is not available!!');
        }
    }
}