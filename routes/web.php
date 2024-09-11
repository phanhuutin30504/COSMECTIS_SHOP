<?php

use App\Http\Controllers\Address\AddressController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\Contract\ContactController;
use App\Http\Controllers\Customer\LoginController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Homepage\HomeController;
use App\Http\Controllers\Customer\RegisterController;
use App\Http\Controllers\Information\PolicyController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index'])->name('index');
Route::get('/search',[HomeController::class,'search'])->name('search');
// Customer
Route::prefix('customer')->group(function(){
Route::post('/register',[RegisterController::class,'register'])->name('register');
Route::post('/login',[LoginController::class,'login'])->name('customer.login');
Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::get('/activate/{token}', [RegisterController::class, 'activate'])->name('activate');
});
// Profile Customer
Route::get('/show-customer/{id}',[ProfileController::class,'show'])->name('show.customer');
Route::post('/update-customer/{id}',[ProfileController::class,'updatePassword'])->name('update.customer');
Route::get('/shipping-default/{id}',[ProfileController::class,'shippingDefault'])->name('shipping.customer');
Route::get('/get-districts/{province_id}', [ProfileController::class, 'getDistricts']);
Route::get('/get-wards/{district_id}', [ProfileController::class, 'getWards']);
//Product
Route::get('/product',[ProductController::class,'index'])->name('product.index');
Route::get('/product-detail/{id}',[ProductController::class,'detail'])->name('product.detail');
//Information
Route::get('information/returnPolicy',[PolicyController::class,'returnPolicy'])->name('returnPolicy');
Route::get('information/paymentPolicy',[PolicyController::class,'paymentPolicy'])->name('paymentPolicy');
Route::get('information/deliveryPolicy',[PolicyController::class,'deliveryPolicy'])->name('deliveryPolicy');

//Contact
Route::get('/contact-form',[ContactController::class,'index'])->name('contact.form');
Route::post('/send-contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/comment', [ContactController::class, 'comment'])->name('comment.send');

Route::middleware('customer')->group(function () {
// Cart
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/remove/{productId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
});

Route::get('order-success', function () {
    return view('cart.orderSuccess');
});
Route::get('my-order/{id}',[OrderController::class,'myOrder'])->name('myOrder');
Route::post('/order',[OrderController::class,'order'])->name('order');
Route::get('/get-shipping-fee', [OrderController::class, 'getShippingFee'])->name('getShippingFee');



