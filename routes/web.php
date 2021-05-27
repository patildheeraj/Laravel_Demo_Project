<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CMSManagementController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MainContraoller;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportExportController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Models\CMSManagement;
use Illuminate\Support\Facades\Route;


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

Route::group(['middleware' => 'AuthCheck'], function () {


    Route::get('/admin', function () {
        return view('layouts.dashboard');
    });

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
    Route::get('/admin/edit-configuration', [ConfigurationController::class, 'editConfiguration'])->name('configuration.edit');
    Route::post('/admin/update-configuration', [ConfigurationController::class, 'updateConfiguration'])->name('configuration.update');

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

    //CMS Management Route
    Route::get('/admin/list-cms-page', [CMSManagementController::class, 'viewCMSPage']);
    Route::get('/admin/add-cms-page', [CMSManagementController::class, 'addCMSPage']);
    Route::post('/admin/store-cms-page', [CMSManagementController::class, 'StoreCMSPage']);
    Route::get('/admin/edit-cms-page/{id}', [CMSManagementController::class, 'editCMSPage']);
    Route::post('/admin/update-cms-page', [CMSManagementController::class, 'updateCMSPage']);
    Route::get('/admin/delete-cms-page/{id}', [CMSManagementController::class, 'deleteCMSPage']);


    //User Feedback
    Route::get('/admin/user-feedback', [ContactUsController::class, 'userFeedback'])->name('user.feedback');
    Route::get('/admin/delete-feedback/{id}', [ContactUsController::class, 'deleteFeedback']);
    Route::post('/admin/reply', [ContactUsController::class, 'reply'])->name('feedback.reply');

    //View frontend register user list route
    Route::get('/view-frontend-user', [UserController::class, 'frontendUser']);

    //Admin Orders Route
    Route::get('/admin/view-order', [ProductController::class, 'viewOrder'])->name('view.order');
    //Orders Detail route
    Route::get('/admin/view-order/{id}', [ProductController::class, 'orderDetail'])->name('order.detail');
    //order status update
    Route::post('/admin/order-status-update', [ProductController::class, 'orderStatusUpdate'])->name('order.status');
    //Invoice Route
    Route::get('/admin/order-invoice/{id}', [ProductController::class, 'orderInvoice'])->name('order.invoice');
});

Route::get('/adminlogin', [MainContraoller::class, 'login'])->name('auth.login');
Route::get('/adminregister', [MainContraoller::class, 'register'])->name('auth.register');
Route::post('/add-user', [MainContraoller::class, 'saveUser'])->name('auth.save');
Route::post('/check', [MainContraoller::class, 'checkUser'])->name('auth.check');

//Report Route
Route::get('/admin/reports', [ReportExportController::class, 'report']);
Route::get('/admin/reports/productExport', [ReportExportController::class, 'productExport']);
Route::get('/admin/reports/customerExport', [ReportExportController::class, 'customerExport']);
Route::get('/admin/reports/couponExport', [ReportExportController::class, 'couponExport']);

Route::get('/admin-logout', function () {
    session()->forget('LoggedUser');
    session()->forget('Logged_Email');
    return redirect('/adminlogin');
})->name('auth.logout');







/**-------------------------------------------------------------------------------------------------------------------------------------------------------------- */


/* Admin Route Ends */


/* Front End Route Start */
Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/categories-products/{slug}', [FrontController::class, 'category_products'])->name('category.products');


Route::get('/wishlist', function () {
    return view('front_end.account');
});


//WishList Route
Route::get('/wishlist', [WishlistController::class, 'viewWishlist'])->name('view.wishlist');
Route::get('/add-wishlist/{pid}', [WishlistController::class, 'addToWishlist'])->name('add.wishlist');
Route::get('/delete-wishlist-item/{product_id}', [WishlistController::class, 'deleteWishlistItem'])->name('delete.wishlist.item');
Route::get('/update-wishlist/{product_id}', [WishlistController::class, 'updateWishlistQuantity']);

//Carts Route
Route::get('/cart', [CartController::class, 'viewCart'])->name('view.cart');
Route::post('/add-cart', [CartController::class, 'addToCart'])->name('add.cart');
Route::get('/delete-cart-item/{product_id}/{quantity}', [CartController::class, 'deleteCartItem'])->name('delete.cart.item');
Route::get('/update-quantity/{product_id}/{quantity}', [CartController::class, 'updateCartQuantity']);

//Apply Coupon Route

Route::post('/apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');

//Product Details Page Route
Route::get('/productDetail/{product_id}', [FrontController::class, 'productDetail']);

Route::get('/login', function () {
    return view('front_end.login');
});

Route::post('/login', [FrontController::class, 'front_login'])->name('frontuser.login');

Route::get('/register', function () {
    return view('front_end.register');
});
Route::post('/register', [FrontController::class, 'front_register'])->name('frontuser.store');
Route::get('/confirm/{code}', [FrontController::class, 'activeAccount']);

Route::get('/products', [FrontController::class, 'productFetch'])->name('product.show');

Route::get('/404', function () {
    return view('front_end.404');
});
Route::get('/contact', [ContactUsController::class, 'contactForm']);


Route::post('/submit-contactForm', [ContactUsController::class, 'submitContactForm'])->name('contact.form');

//Report Route

//CMS Pages Route
Route::get('/page/{url}', [CMSManagementController::class, 'CMSPages']);

Route::group(['middleware' => ['frontlogin']], function () {

    //NewsLetter Route
    Route::post('/newsletter', [NewsletterController::class, 'store'])->name('news.letter');

    //Account Route
    Route::get('/account', [FrontController::class, 'accountManage'])->name('front.account');
    Route::post('/update-account', [FrontController::class, 'updateAccount'])->name('update.account');
    Route::post('/update-password', [FrontController::class, 'updatePassword'])->name('update.password');
    //Save Delivery Address
    Route::post('/saveAddress', [FrontController::class, 'saveAddress'])->name('save.address');
    //Checkout Route
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout.page');
    //Order Review Page
    Route::get('/order-review', [FrontController::class, 'orderReview']);
    //order place Route
    Route::match(['get', 'post'], '/place-order', [FrontController::class, 'placeOrder']);
    //My order Route
    Route::get('/my-order', [FrontController::class, 'myOrder']);
    //Thank-you Page Route
    Route::get('thank-you', [FrontController::class, 'thankYou']);
    //Paypal Page Route
    Route::get('paypal', [FrontController::class, 'paypal']);
});


//Logout Route
Route::get('/logout', function () {
    session()->forget('FRONT_LOGIN');
    session()->forget('FRONT_ID');
    session()->forget('FRONT_USER');
    session()->forget('FRONT_Email');
    session()->forget('session_id');
    session()->forget('CouponAmount');
    session()->forget('CouponCode');
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