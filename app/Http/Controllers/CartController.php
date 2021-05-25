<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DelivaryAddress;
use App\Models\FrontUser;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');

        $data = Product::find($request->product_id);
        $user_email = Session::get('FRONT_Email');
        $product_code = $data->product_code;
        $session_id = Session::get('session_id');

        if (empty($session_id)) {
            $session_id = str_random(10);
            Session::put('session_id', $session_id);
        }

        if (empty($user_email)) {
            $user_email = '';
        }

        if (empty(Session::get('FRONT_LOGIN'))) {
            $countProduct = DB::table('carts')->where(['product_id' => $request->product_id, 'session_id' => $session_id])->count();
            if ($countProduct == 1) {
                return back()->with('success', 'Item already exist in cart!!');
            } elseif ($data->pstock < $request->quantity) {
                return back()->with('fail', 'only ' . $data->pstock . ' product stock is available');
            } else {

                $cart = new Cart();

                $cart->product_id = $request->product_id;
                $cart->product_code = $product_code;
                $cart->product_name = $data->pname;
                $cart->product_price = $data->pprice;
                $cart->product_image = $data->pimage;
                $cart->user_email = $user_email;
                $cart->quantity = $request->quantity;;
                $cart->session_id = $session_id;
                $cart->save();
                DB::table('products')->where('pid', $request->product_id)->decrement('pstock', $request->quantity);
                return redirect('/cart')->with('success', 'Item added in cart successfully!!');
            }
        } else {
            $countProduct = DB::table('carts')->where(['product_id' => $request->product_id, 'user_email' => $user_email])->count();
            if ($countProduct == 1) {
                return back()->with('success', 'Item already exist in cart!!');
            } elseif ($data->pstock < $request->quantity) {
                return back()->with('fail', 'only ' . $data->pstock . ' product stock is available');
            } else {

                $cart = new Cart();

                $cart->product_id = $request->product_id;
                $cart->product_code = $product_code;
                $cart->product_name = $data->pname;
                $cart->product_price = $data->pprice;
                $cart->product_image = $data->pimage;
                $cart->user_email = $user_email;
                $cart->quantity = $request->quantity;;
                $cart->session_id = $session_id;
                $cart->save();
                DB::table('products')->where('pid', $request->product_id)->decrement('pstock', $request->quantity);
                return redirect('/cart')->with('success', 'Item added in cart successfully!!');
            }
        }
    }

    public function viewCart()
    {
        $session_id = Session::get('session_id');
        $user_email = Session::get('FRONT_Email');
        if (empty(Session::get('FRONT_LOGIN'))) {
            $cart = Cart::where('Session_id', '=', $session_id)->get();
        } else {
            $cart = Cart::where('user_email', '=', $user_email)->get();
        }
        // echo '<pre>';
        // print_r($cart);
        // die();
        return view('front_end.cart', compact('cart'));
    }

    public function deleteCartItem($product_id, $quantity)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('products')->where('pid', $product_id)->increment('pstock', $quantity);
        DB::table('carts')->where(['product_id' => $product_id])->delete();
        return back()->with('success', 'Item deleted successfully!!');
    }

    public function updateCartQuantity($product_id, $quantity)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $cartDetail = DB::table('carts')->where('product_id', $product_id)->first();
        $product = DB::table('products')->where('product_code', $cartDetail->product_code)->first();
        $updatedQuantity = ($cartDetail->quantity) + ($quantity);
        // echo $updatedQuantity;
        // die();
        if ($product->pstock >= $updatedQuantity) {
            DB::table('carts')->where('product_id', $product_id)->increment('quantity', $quantity);
            return back()->with('success', 'Item quantity has been increases successfully!!');
        } else {
            return back()->with('fail', 'sufficient stock is not available!!');
        }
    }

    public function applyCoupon(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $couponCount = Coupon::where('coupon_code', $request->coupon_code)->count();
        if ($couponCount == 0) {
            return back()->with('fail', 'Coupon code does not exists try another!!');
        }
        $coupon = Coupon::where(['coupon_code' => $request->coupon_code])->first();
        if ($coupon->status == 0) {
            return back()->with('fail', 'Coupon code is not active try another!!');
        }
        $expiry_date = $coupon->Exp_date;
        $current_date = date('d-m-Y');
        if ($expiry_date < $current_date) {
            return back()->with('fail', 'Coupon code is Expired!!');
        }

        $session_id = Session::get('session_id');
        //$list = Cart::where('session_id', '=', $session_id)->get();
        $user_email = Session::get('FRONT_Email');
        if (empty(Session::get('FRONT_LOGIN'))) {
            $list = Cart::where('Session_id', '=', $session_id)->get();
        } else {
            $list = Cart::where('user_email', '=', $user_email)->get();
        }

        $total_amount = 0;
        $CouponAmount = 0;
        foreach ($list as $item) {
            $total_amount = $total_amount + ($item->product_price * $item->quantity);
        }

        if ($coupon->coupon_type == 'Fixed') {
            if ($total_amount >= $coupon->minimum_purchase) {
                $CouponAmount = $coupon->coupon_value;
                //echo $CouponAmount;
            } else {
                return back()->with('fail', 'Cart amount should be greater then or equal to ' . $coupon->minimum_purchase . ' Rs. without including shipping charges.');
            }
        } else {
            if ($total_amount >= $coupon->minimum_purchase) {
                $CouponAmount = ($total_amount * $coupon->coupon_value) / 100;
                //echo $CouponAmount;
            } else {
                return back()->with('fail', 'Cart amount should be greater then or equal to ' . $coupon->minimum_purchase . ' Rs. without including shipping charges.');
            }
        }
        Session::put('CouponAmount', $CouponAmount);
        Session::put('CouponCode', $coupon->coupon_code);

        // echo $a = Session::get('CouponAmount') . $b = Session::get('CouponCode');
        // die();
        return back()->with('success', 'Coupon Applied Successfully!!');
    }

    public function checkout()
    {
        $session_id = session()->get('session_id');
        $user_email = session()->get('FRONT_Email');

        DB::table('carts')->where(['session_id' => $session_id])->update(['user_email' => $user_email]);
        $user_id = session()->get('FRONT_ID');
        $country = DB::table('countries')->get();
        $user = FrontUser::find($user_id);
        $shippingDetail = array();
        $shippingAddress = DelivaryAddress::where('user_id', $user_id)->count();
        if ($shippingAddress > 0) {
            $shippingDetail = DelivaryAddress::where('user_id', $user_id)->first();
        }
        return view('front_end.checkout', compact('user', 'country', 'shippingDetail'));
    }
}