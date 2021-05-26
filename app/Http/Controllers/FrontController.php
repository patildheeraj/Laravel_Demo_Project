<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\DelivaryAddress;
use App\Models\FrontUser;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function home()
    {
        $result['banner'] = DB::table('banners')->get();
        $result['category'] = DB::table('categories')->get();
        $result['products'] = DB::table('products')->paginate(6);
        //print_r($result['products']);
        //die();
        $data = Category::with('categories')->where(['parent_category_id' => 0])->get();
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
        // die();
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        return view('front_end.home', $result)->with(compact('data'));
    }

    public function category_products($slug)
    {
        $data = Category::with('categories')->where(['parent_category_id' => 0])->get();
        $banner = DB::table('banners')->get();
        $category = Category::where(['slug' => $slug])->first();
        $products = Product::where(['pcategory' => $category->cid])->get();
        // echo $category . '<br>' . $products;
        // die();
        return view('front_end.listing')->with(compact('data', 'products', 'category', 'banner'));
    }

    public function front_register(Request $request)
    {
        if ($request->session()->has('FRONT_LOGIN') != null) {
            return redirect('/');
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:front_users,email',
            'password' => 'required|alpha_num',
            'conpassword' => 'required|same:password',
        ], [
            'name.required' => '**Name is required',
            'email.required' => '**Email is required',
            'email.unique' => '**Email already exist',
            'password.required' => '**Password is required',
            'conpassword.required' => '**Confirm Password is required',
            'conpassword.same' => '**Both password must be same',
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        // echo "<pre>";
        // print_r(md5($password));
        // die();
        $newUser = new FrontUser();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->save();

        //Send Register Email
        // $messageData = ['email' => $email, 'name' => $name];
        // Mail::send('emails.register_email', $messageData, function ($message) use ($email) {
        //     $message->to($email)->subject('Welcome to E-Shopper - Registration Successful');
        // });

        //Confirm Email
        $messageData = ['email' => $email, 'name' => $name, 'code' => base64_encode($email)];
        Mail::send('emails.confirmation_mail', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Welcome to E-Shopper - Confirmation email for your account');
        });

        $request->session()->flash('success', 'New user added successfully check your email for confirm your account!!');
        return redirect('/login');
    }

    public function activeAccount($email)
    {
        $mail = base64_decode($email);
        $userCount = DB::table('front_users')->where(['email' => $mail])->count();

        if ($userCount > 0) {
            $user = DB::table('front_users')->where(['email' => $mail])->first();
            if ($user->status == 1) {
                return redirect('/login')->with('success', 'Your email account is already activated, You can login now!!');
            } else {
                DB::table('front_users')->where(['email' => $mail])->update(['status' => 1]);

                //Send Register Email
                $messageData = ['email' => $email, 'name' => $user->name];
                Mail::send('emails.register_email', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Welcome to E-Shopper - Registration Successful');
                });

                return redirect('/login')->with('success', 'Your email account is activated successfully, You can login now!!');
            }
        } else {
            return redirect('/login')->with('fail', 'Your email account not exists!!');
        }
    }

    public function front_login(Request $request)
    {
        if ($request->session()->has('FRONT_LOGIN') != null) {
            return redirect('/');
        }
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = DB::table('front_users')->where(['email' => $email])->first();
        if ($user) {
            if ($user->status == 0) {
                return redirect('/login')->with('fail', 'Your email account is not activated, contact admin!!');
            }
            if ($user->password == $password) {
                // echo '<pre>';
                // print_r($user);
                // die();
                $request->session()->put('FRONT_LOGIN', true);
                $request->session()->put('FRONT_ID', $user->id);
                $request->session()->put('FRONT_USER', $user->name);
                $request->session()->put('FRONT_Email', $user->email);

                $session_id = Session::get('session_id');
                if (!empty($session_id)) {
                    DB::table('carts')->where('session_id', $session_id)->update(['user_email' => $user->email]);
                }
                return redirect('/')->with('success', 'Login successfully!!');
            } else {
                $request->session()->flash('fail', 'Enter valid Password');
                return redirect('/login');
            }
        } else {
            $request->session()->flash('fail', 'Enter valid Email');
            return redirect('/login');
        }
    }

    public function forgot_password()
    {
        return view('front_end.forgot');
    }

    public function changeForgotPassword(Request $request)
    {
        //print_r($request->all());
        $request->validate([
            'email' => 'required'
        ]);

        $user = DB::table('front_users')->where('email', '=', $request->email)->first();

        if (!$user) {

            $request->session()->flash('fail', 'Email not found in record!!');
            return redirect()->back();
        } else {
            // echo ' Email Exits' . '<pre>';
            // print_r($user);
            //Generate new
            $random_password = str_random(8);

            FrontUser::where('email', $request->email)->update(['password' => $random_password]);

            $email = $user->email;
            $name = $user->name;
            $password = $random_password;
            $messageData = [
                'email' => $email,
                'name' => $name,
                'password' => $password
            ];
            Mail::send('front_end.forgot_email', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('New Password - E-shopper website');
            });
            $request->session()->flash('success', 'New password sent to your mail.');
            return redirect('/login');
        }
    }

    public function accountManage()
    {
        $session_id = session()->get('FRONT_ID');
        $country = DB::table('countries')->get();
        $user = FrontUser::find($session_id);
        // echo '<pre>';
        // print_r($user);
        // die();
        return view('front_end.account', compact('user', 'country'));
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required|integer',
            'address' => 'required',
            'city' => 'required|alpha',
            'state' => 'required|alpha',
            'country' => 'required',
            'pincode' => 'required|integer',

        ]);
        $session_email = session()->get('FRONT_Email');

        $result['name'] = $request->name;
        $result['mobile'] = $request->mobile;
        $result['address'] = $request->address;
        $result['city'] = $request->city;
        $result['state'] = $request->state;
        $result['country'] = $request->country;
        $result['pincode'] = $request->pincode;

        // echo '<pre>';
        // print_r($session_id);
        // die();
        DB::table('front_users')->where('email', '=', $session_email)->update($result);
        // echo '<pre>';
        // print_r($user);
        // die();
        $request->session()->flash('success', 'User Account Update Successfully!');
        return redirect('/account');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'conpassword' => 'required|same:new_password',
        ]);
        $session_email = session()->get('FRONT_Email');
        DB::table('front_users')->where('email', '=', $session_email)->update(['password' => $request->new_password]);
        return back()->with('pwd', 'Password updated successfully!!');
    }

    public function productDetail($product_id)
    {
        $data = Category::with('categories')->where(['parent_category_id' => 0])->get();
        $product = DB::table('products')->where('pid', $product_id)->first();
        return view('front_end.productDetail', compact('data', 'product'));
    }

    public function productFetch()
    {
        $data = Category::with('categories')->where(['parent_category_id' => 0])->get();
        $products = Product::all();
        return view('front_end.product', compact('data', 'products'));
    }

    public function saveAddress(Request $request)
    {
        $request->validate([
            'billing_name' => 'required',
            'billing_address' => 'required',
            'billing_city' => 'required',
            'billing_state' => 'required',
            'billing_country' => 'required',
            'billing_pincode' => 'required',
            'billing_mobile' => 'required',
            'billing_email' => 'required',
            'shipping_name' => 'required',
            'shipping_address' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_country' => 'required',
            'shipping_pincode' => 'required',
            'shipping_mobile' => 'required',
            'shipping_email' => 'required',
        ]);

        $data = $request->all();
        $session_email = Session::get('FRONT_Email');
        $session_id = Session::get('FRONT_ID');

        FrontUser::where('email', $session_email)->update(['name' => $data['billing_name'], 'email' => $data['billing_email'], 'address' => $data['billing_address'], 'city' => $data['billing_city'], 'state' => $data['billing_state'], 'country' => $data['billing_country'], 'pincode' => $data['billing_pincode'], 'mobile' => $data['billing_mobile']]);

        $shippingAddress = DelivaryAddress::where('user_id', $session_id)->count();
        if ($shippingAddress > 0) {
            DelivaryAddress::where('user_id', $session_id)->update(['name' => $data['shipping_name'], 'user_email' => $data['shipping_email'], 'address' => $data['shipping_address'], 'city' => $data['shipping_city'], 'state' => $data['shipping_state'], 'country' => $data['shipping_country'], 'pincode' => $data['shipping_pincode'], 'mobile' => $data['shipping_mobile']]);
        } else {
            $model = new DelivaryAddress();
            $model->user_id = $session_id;
            $model->user_email = $session_email;
            $model->name = $data['shipping_name'];
            $model->address = $data['shipping_address'];
            $model->city = $data['shipping_city'];
            $model->state = $data['shipping_state'];
            $model->country = $data['shipping_country'];
            $model->pincode = $data['shipping_pincode'];
            $model->mobile = $data['shipping_mobile'];
            $model->save();
        }
        return redirect()->action([FrontController::class, 'orderReview']);
    }

    public function orderReview()
    {
        $session_email = Session::get('FRONT_Email');
        $session_id = Session::get('FRONT_ID');
        $user = FrontUser::where('id', $session_id)->first();
        $shippingDetail = DelivaryAddress::where('user_id', $session_id)->first();
        $cart = Cart::where('user_email', '=', $session_email)->get();

        // echo '<pre>';
        // print_r($coupon->minimum_purchase);
        // die();
        return view('front_end.order_review', compact('user', 'shippingDetail', 'cart'));
    }

    public function placeOrder(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $user_id = Session::get('FRONT_ID');
            $user_email = Session::get('FRONT_Email');
            $CouponAmount = Session::get('CouponAmount');
            $CouponCode  = Session::get('CouponCode');
            if (empty($CouponAmount) && empty($CouponCode)) {
                $CouponAmount = 0;
                $CouponCode  = 'Not Applied';
            }

            $shippingDetail = FrontUser::where('email', $user_email)->first();
            // echo '<pre>';
            // print_r(json_decode(json_encode($shippingDetail)));
            // die();
            $order = new Order();
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetail->name;
            $order->address = $shippingDetail->address;
            $order->city = $shippingDetail->city;
            $order->state = $shippingDetail->state;
            $order->country = $shippingDetail->country;
            $order->pincode = $shippingDetail->pincode;
            $order->mobile = $shippingDetail->mobile;
            $order->shipping_charges = $data['shippingCharges'];
            $order->coupon_code = $CouponCode;
            $order->coupon_amount = $CouponAmount;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('carts')->where('user_email', $user_email)->get();
            foreach ($cartProducts as $item) {
                $cartPro = new OrderProduct();
                $cartPro->order_id = $order_id;
                $cartPro->user_id = $user_id;
                $cartPro->product_id = $item->product_id;
                $cartPro->product_code = $item->product_code;
                $cartPro->product_name = $item->product_name;
                $cartPro->product_price = $item->product_price;
                $cartPro->product_image = $item->product_image;
                $cartPro->product_qyt = $item->quantity;
                $cartPro->save();
            }
            Session::put('order_id', $order_id);
            Session::put('grand_total', $data['grand_total']);

            if ($data['payment_method'] == 'COD') {

                $userDetails = FrontUser::where('id', $user_id)->first();
                $productDetails = Order::with('orders')->where('id', $order_id)->first();
                $shippingAddress = DelivaryAddress::where('user_id', $user_id)->first();
                // echo '<pre>';
                // print_r(json_decode(json_encode($shippingAddress)));
                // die();
                //Code of order email
                $email = $user_email;
                $messageData = [
                    'email' => $email,
                    'name' => $shippingDetail->name,
                    'order_id' => $order_id,
                    'userDetails' => $userDetails,
                    'productDetails' => $productDetails,
                    'shippingAddress' => $shippingAddress
                ];
                Mail::send('emails.order_email', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Order Placed - E-shopper Website');
                });
                return redirect('/thank-you');
            } else {
                return redirect('/paypal');
            }
        }
    }

    public function thankYou()
    {
        $user_email = Session::get('FRONT_Email');
        DB::table('carts')->where('user_email', $user_email)->delete();
        return view('front_end.thanks');
    }

    public function  paypal()
    {
        $user_email = Session::get('FRONT_Email');
        $user_id = Session::get('FRONT_ID');
        $orderDetails = Order::where('user_id', $user_id)->first();
        $nameArr = explode(' ', $orderDetails->name);
        // echo '<pre>';
        // print_r(json_decode(json_encode($nameArr[0])));
        // die();

        DB::table('carts')->where('user_email', $user_email)->delete();


        return view('front_end.paypal', compact('orderDetails', 'nameArr'));
    }

    public function myOrder()
    {
        $user_id = Session::get('FRONT_ID');
        $userDetails = FrontUser::where('id', $user_id)->first();
        $shippingDetail = DelivaryAddress::where('user_id', $user_id)->first();
        $orders = Order::with('orders')->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
        // echo '<pre>';
        // print_r(json_decode(json_encode($userDetails)));
        // die();
        return view('front_end.my_order', compact('orders', 'userDetails', 'shippingDetail'));
    }
}