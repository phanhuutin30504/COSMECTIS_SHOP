<?php
//admin

use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/login',[LoginController::class,'index']);

Route::get('/dashboard', function () {
    return view('admin.home.index');
});
// Order
Route::prefix('order')->group(function(){
    Route::get('/', function () {
        return view('admin.order.list');
    });
    Route::get('/edit', function () {
        return view('admin.order.edit');
    });
    Route::get('/detail', function () {
        return view('admin.order.detail');
    });
    Route::get('/add', function () {
        return view('admin.order.add');
    });
    Route::get('/add-item', function () {
        return view('admin.order.add_item');
    });

});
// Order Status
Route::prefix('order-status')->group(function(){
    Route::get('/', function () {
        return view('admin.order_status.list');
    });
    Route::get('/edit', function () {
        return view('admin.order_status.edit');
    });

});
//Product
Route::prefix('product')->group(function(){
    Route::get('/', function () {
        return view('admin.product.list');
    });
    Route::get('/edit', function () {
        return view('admin.product.edit');
    });
    Route::get('/add', function () {
        return view('admin.product.add');
    });

});
//Comment
Route::prefix('comment')->group(function(){
    Route::get('/', function () {
        return view('admin.comment.list');
    });
});
//Image
Route::prefix('image')->group(function(){
    Route::get('/', function () {
        return view('admin.image.list');
    });
});
//Customer
Route::prefix('customer')->group(function(){
    Route::get('/', function () {
        return view('admin.customer.list');
    });
    Route::get('/edit', function () {
        return view('admin.customer.edit');
    });
    Route::get('/add', function () {
        return view('admin.customer.add');
    });
});
//Category
Route::prefix('category')->group(function(){
    Route::get('/', function () {
        return view('admin.category.list');
    });
    Route::get('/edit', function () {
        return view('admin.category.edit');
    });
    Route::get('/add', function () {
        return view('admin.category.add');
    });
});
//Promotion
Route::prefix('promotion')->group(function(){
    Route::get('/', function () {
        return view('admin.promotion.list');
    });
    Route::get('/edit', function () {
        return view('admin.promotion.edit');
    });
    Route::get('/add', function () {
        return view('admin.promotion.add');
    });
    Route::get('/add-item', function () {
        return view('admin.promotion.add_item');
    });
});
//Transport
Route::prefix('transport')->group(function(){
    Route::get('/', function () {
        return view('admin.transport.list');
    });
    Route::get('/edit', function () {
        return view('admin.transport.edit');
    });
    Route::get('/add', function () {
        return view('admin.transport.add');
    });

});
//User
Route::prefix('user')->group(function(){
    Route::get('/', function () {
        return view('admin.user.list');
    });
    Route::get('/edit', function () {
        return view('admin.user.edit');
    });
    Route::get('/add', function () {
        return view('admin.user.add');
    });
});
//Permission
Route::prefix('permission')->group(function(){
    Route::get('/roles', function () {
        return view('admin.permission.roles');
    });
    Route::get('/edit-role', function () {
        return view('admin.permission.edit_role');
    });
    Route::get('/add-role', function () {
        return view('admin.permission.add_role');
    });
    Route::get('/actions', function () {
        return view('admin.permission.actions');
    });
    Route::get('/edit-action', function () {
        return view('admin.permission.edit_action');
    });
    Route::get('/add-action', function () {
        return view('admin.permission.add_role_action');
    });
    Route::get('/role-action', function () {
        return view('admin.permission.role_action');
    });
});
//Newsletter
Route::prefix('newsletter')->group(function(){
    Route::get('/', function () {
        return view('admin.newsletter.list');
    });
    Route::get('/send', function () {
        return view('admin.newsletter.send');
    });

});
