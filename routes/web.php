<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
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
/*
Route::get('/', function () {
return view('welcome');
});

Route::get('/dashboard', function () {
return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 */
require __DIR__ . '/auth.php';

Route::middleware('dashboard')->group(function () {

});
Route::group(['middleware' => 'auth'], function () {
    //dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //category route
    Route::resource('/category', CategoryController::class)->names('category');
    //product route
    Route::resource('/product', ProductController::class)->names('product')->except('show');
    Route::get('/product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::put('/product/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::delete('/product/{product}/force-delete', [ProductController::class, 'forceDelete'])->name('product.forceDelete');
    //store route
    Route::resource('/store', StoreController::class)->names('store');
    //user route
    Route::resource('/user', UserController::class)->names('user');
    Route::get('profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{user}/update', [ProfileController::class, 'update'])->name('profile.update');
    //setting route
    Route::get('setting/edit', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('setting/{setting}/update', [SettingController::class, 'update'])->name('setting.update');

});
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('/product/{product:slug}/show', [HomeController::class, 'show'])->name('front.products.show');
Route::resource('cart',CartController::class)->names('cart');
Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout.create');
Route::post('checkout/store', [CheckoutController::class, 'store'])->name('checkout.store');


