<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MainContraoller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('layouts.dashboard');
});

Route::get('/login', [MainContraoller::class, 'login'])->name('auth.login');
Route::get('/register', [MainContraoller::class, 'register'])->name('auth.register');
Route::post('/add-user', [MainContraoller::class, 'saveUser'])->name('auth.save');
Route::post('check', [MainContraoller::class, 'checkUser'])->name('auth.check');


Route::group(['middleware' => 'AuthCheck'], function () {

    Route::get('/login', [MainContraoller::class, 'login'])->name('auth.login');
    Route::get('/register', [MainContraoller::class, 'register'])->name('auth.register');

    Route::get('/admin', function () {
        return view('layouts.dashboard');
    });
    Route::get('/logout', [MainContraoller::class, 'logout'])->name('auth.logout');
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
Route::get('/admin/configuration-list', [ConfigurationController::class, 'show'])->name('configuration.fetch');
Route::get('/admin/configuration-add', [ConfigurationController::class, 'addConfiguration'])->name('configuration.add');
Route::post('/admin/configuration-store', [ConfigurationController::class, 'storeConfiguration'])->name('configuration.store');
Route::get('/admin/edit-configuration/{id}', [ConfigurationController::class, 'editConfiguration'])->name('configuration.edit');
Route::post('/admin/update-configuration', [ConfigurationController::class, 'updateConfiguration'])->name('configuration.update');
Route::get('/admin/delete-configuration/{id}', [ConfigurationController::class, 'deleteConfiguration'])->name('configuration.delete');