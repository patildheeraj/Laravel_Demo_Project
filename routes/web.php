<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MainContraoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\FrontLogin;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/* Admin Route Start */

Route::get('/admin', function () {
    return view('layouts.dashboard');
});

//Route::get('/login', [MainContraoller::class, 'login'])->name('auth.login');
//Route::get('/register', [MainContraoller::class, 'register'])->name('auth.register');


Route::group(['middleware' => 'AuthCheck'], function () {

    Route::get('/admin', function () {
        return view('layouts.dashboard');
    });
});

Route::get('/adminlogin', [MainContraoller::class, 'login'])->name('auth.login');
Route::get('/adminregister', [MainContraoller::class, 'register'])->name('auth.register');
Route::post('/add-user', [MainContraoller::class, 'saveUser'])->name('auth.save');
Route::post('/check', [MainContraoller::class, 'checkUser'])->name('auth.check');

Route::get('/admin-logout', function () {
    session()->forget('LoggedUser');
    session()->forget('Logged_Email');
    return redirect('/adminlogin');
})->name('auth.logout');



// Category Management
Route::get('/admin/category-list', [CategoryController::class, 'getCategory'])->name('category.fetch');
Route::get('/admin/add-category', [CategoryController::class, 'addCategory'])->name('category.add');
Route::post('/admin/category-store', [CategoryController::class, 'storeCategory'])->name('category.store');
Route::get('/admin/edit-category/{id}', [CategoryController::class, 'editCategory'])->name('category.edit');
Route::post('/admin/update-category', [CategoryController::class, 'updateCategory'])->name('category.update');
Route::get('/admin/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('category.delete');

// Product Management
Route::get('/admin/product-list', [ProductController::class, 'getProduct'])->name('product.fetch');
Route::get('/admin/add-product', [ProductController::class, 'addProduct'])->name('product.add');
Route::post('/admin/store-product', [ProductController::class, 'storeProduct'])->name('product.store');
Route::get('/admin/edit-product/{id}', [ProductController::class, 'editProduct'])->name('product.edit');
Route::post('/admin/update-product', [ProductController::class, 'updateProduct'])->name('product.update');
Route::get('/admin/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');

// Admin User MAnagement
Route::get('/admin/user-list', [UserController::class, 'getUsers'])->name('user.fetch');
Route::get('/admin/add-user', [UserController::class, 'addUser'])->name('user.add');
Route::post('/admin/user-store', [UserController::class, 'storeUser'])->name('user.store');
Route::get('/admin/edit-user/{id}', [UserController::class, 'editUser'])->name('user.edit');
Route::post('/admin/user-update', [UserController::class, 'updateUser'])->name('user.update');
Route::get('/admin/delete-user/{id}', [UserController::class, 'deleteUser'])->name('user.delete');

//Configuration Management
// Route::get('/admin/configuration-list', [ConfigurationController::class, 'show'])->name('configuration.fetch');
// Route::get('/admin/configuration-add', [ConfigurationController::class, 'addConfiguration'])->name('configuration.add');
// Route::post('/admin/configuration-store', [ConfigurationController::class, 'storeConfiguration'])->name('configuration.store');
Route::get('/admin/edit-configuration', [ConfigurationController::class, 'editConfiguration'])->name('configuration.edit');
Route::post('/admin/update-configuration', [ConfigurationController::class, 'updateConfiguration'])->name('configuration.update');
//Route::get('/admin/delete-configuration/{id}', [ConfigurationController::class, 'deleteConfiguration'])->name('configuration.delete');

//Banner Management
Route::get('/admin/banner-list', [BannerController::class, 'show'])->name('Banner.fetch');
Route::get('/admin/banner-add', [BannerController::class, 'addBanner'])->name('Banner.add');
Route::post('/admin/banner-store', [BannerController::class, 'storeBanner'])->name('Banner.store');
Route::get('/admin/edit-banner/{id}', [BannerController::class, 'editBanner'])->name('Banner.edit');
Route::post('/admin/update-banner', [BannerController::class, 'updateBanner'])->name('Banner.update');
Route::get('/admin/delete-banner/{id}', [BannerController::class, 'deleteBanner'])->name('Banner.delete');

//Coupon Management
Route::get('/admin/coupon-list', [CouponController::class, 'show'])->name('coupon.fetch');
Route::get('/admin/coupon-add', [CouponController::class, 'addCoupon'])->name('coupon.add');
Route::post('/admin/coupon-store', [CouponController::class, 'storeCoupon'])->name('coupon.store');
Route::get('/admin/edit-coupon/{id}', [CouponController::class, 'editCoupon'])->name('coupon.edit');
Route::post('/admin/update-coupon', [CouponController::class, 'updateCoupon'])->name('coupon.update');
Route::get('/admin/delete-coupon/{id}', [CouponController::class, 'deleteCoupon'])->name('coupon.delete');
Route::get('/admin/coupon/status/{status}/{id}', [CouponController::class, 'status'])->name('coupon.status');

/* Admin Route Ends */


/* Front End Route Start */
Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/categories-products/{slug}', [FrontController::class, 'category_products'])->name('category.products');


Route::get('/wishlist', function () {
    return view('front_end.account');
});
Route::get('/checkout', function () {
    return view('front_end.checkout');
});
Route::get('/cart', function () {
    return view('front_end.cart');
});
Route::get('/login', function () {
    return view('front_end.login');
});

Route::post('/login', [FrontController::class, 'front_login'])->name('frontuser.login');

Route::get('/register', function () {
    return view('front_end.register');
});
Route::get('/products', [FrontController::class, 'productFetch'])->name('product.show');

Route::post('/register', [FrontController::class, 'front_register'])->name('frontuser.store');

Route::get('/404', function () {
    return view('front_end.404');
});
Route::get('/contact', function () {
    return view('front_end.contact');
});

Route::group(['middleware' => ['frontlogin']], function () {

    Route::get('/account', [FrontController::class, 'accountManage'])->name('front.account');
    Route::post('/update-account', [FrontController::class, 'updateAccount'])->name('update.account');
});

//Logout Route
Route::get('/logout', function () {
    session()->forget('FRONT_LOGIN');
    session()->forget('FRONT_ID');
    session()->forget('FRONT_USER');
    session()->forget('FRONT_Email');
    return redirect('/');
})->name('front.logout');

//Forgot Password
Route::get('/forgot-password', [FrontController::class, 'forgot_password']);
Route::post('/change-password', [FrontController::class, 'changeForgotPassword'])->name('forgot.password');

/* Front End Route End */

//Google Login
Route::get('/google', [SocialController::class, 'redirect']);
Route::get('/callback/google', [SocialController::class, 'callback']);

//Facebook login
Route::get('/facebook', [SocialController::class, 'facebookSubmit']);
Route::get('/facebook/response', [SocialController::class, 'facebookResponse']);

//Github login
Route::get('login/github', [SocialController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [SocialController::class, 'handleGithubCallback']);