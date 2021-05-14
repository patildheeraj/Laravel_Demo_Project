<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FrontUser;
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
        $result['products'] = DB::table('products')->get();
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

        $newUser = new FrontUser();
        $newUser->name = $name;
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->save();
        $request->session()->flash('success', 'New user added successfully!!');
        return redirect('/');
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
            if ($user->password == $password) {
                // echo '<pre>';
                // print_r($user);
                // die();
                $request->session()->put('FRONT_LOGIN', true);
                $request->session()->put('FRONT_ID', $user->id);
                $request->session()->put('FRONT_USER', $user->name);
                $request->session()->put('FRONT_Email', $user->email);

                return redirect('/');
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

            //FrontUser::where('email', $request->email)->update(['password' => $random_password]);

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

    public function productFetch()
    {
        $data = DB::table('products')->get();
        $category = Category::all();
        //echo '<pre>';
        //print_r($data);
        // foreach ($category as $data) {
        //     print_r($data->cname);
        // }
        // die();
        return view('front_end.product', compact('data', 'category'));
    }
}