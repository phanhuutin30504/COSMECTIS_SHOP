<?php
//admin

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Comment\CommentController;
use App\Http\Controllers\Admin\Customer\CustomerController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Order\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\ProductImage\ProductImageController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'index'])->name('form.login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    // Order
    Route::prefix('order')->group(function () {
        Route::get('/',[OrderController::class,'index'])->name('admin.order');
        Route::post('/{id}/confirm', [OrderController::class, 'confirmOrder'])->name('admin.orders.confirm');

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
    Route::prefix('order-status')->group(function () {
        Route::get('/', function () {
            return view('admin.order_status.list');
        });
        Route::get('/edit', function () {
            return view('admin.order_status.edit');
        });
    });
    //Product
    Route::prefix('product')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('admin.product');
        Route::get('/create', [ProductController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('admin.product.destroy');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('admin.product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('admin.product.update');
        Route::delete('/delete-selected', [ProductController::class, 'deleteSelected'])->name('deleteSelected.product');

    });
    //Comment
    Route::prefix('comment')->group(function () {
        Route::get('/detail/{id}', [CommentController::class, 'detail'])->name('admin.comment');
        Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('admin.comment.destroy');
        Route::delete('/delete-selected', [CommentController::class, 'deleteSelected'])->name('deleteSelected.comment');

    });
    //Product Image
    Route::prefix('image')->group(function () {
        Route::get('/products/{id}/images', [ProductImageController::class, 'showImages'])->name('admin.products.showImages');
        Route::post('/admin/products/{id}/images', [ProductImageController::class, 'storeImages'])->name('admin.products.storeImages');
        Route::delete('/admin/products/images/{id}', [ProductImageController::class, 'deleteImage'])->name('admin.products.deleteImage');
        Route::delete('/delete-selected', [ProductImageController::class, 'deleteSelected'])->name('deleteSelected.image');

    });
    //Customer
    Route::prefix('customer')->group(function () {
        Route::get('/', [CustomerController::class,'index'])->name('admin.customer');
        Route::get('/create', [CustomerController::class, 'create'])->name('admin.customer.create');
        Route::post('/store', [CustomerController::class, 'store'])->name('admin.customer.store');
        Route::delete('/destroy/{id}', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');
        Route::get('/show/{id}', [CustomerController::class, 'show'])->name('admin.customer.show');
        Route::put('/update/{id}', [CustomerController::class, 'update'])->name('admin.customer.update');
        Route::delete('/delete-selected', [CustomerController::class, 'deleteSelected'])->name('deleteSelected.customer');


    });
    //Category
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class,'index'])->name('admin.category');
        Route::get('/create', [CategoryController::class,'create'])->name('admin.category.create');
        Route::post('/store', [CategoryController::class,'store'])->name('admin.category.store');
        Route::put('/update/{id}', [CategoryController::class,'update'])->name('admin.category.update');
        Route::delete('/destroy/{id}', [CategoryController::class,'destroy'])->name('admin.category.destroy');
        Route::get('/show/{id}', [CategoryController::class,'show'])->name('admin.category.show');


    });
    //Promotion
    Route::prefix('promotion')->group(function () {
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
    Route::prefix('transport')->group(function () {
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
    Route::prefix('user')->group(function () {
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
    Route::prefix('permission')->group(function () {
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
    Route::prefix('newsletter')->group(function () {
        Route::get('/', function () {
            return view('admin.newsletter.list');
        });
        Route::get('/send', function () {
            return view('admin.newsletter.send');
        });
    });
});
