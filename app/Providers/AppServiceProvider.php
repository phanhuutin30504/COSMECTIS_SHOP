<?php

namespace App\Providers;

use App\Helpers\CartHelper;
use App\Models\Cart;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $user = auth()->guard('customer')->user();
            $cart = $user ? Cart::with('items.product')->where('user_id', $user->id)->first() : null;

            // Nếu có giỏ hàng, lấy các item và tổng giá trị
            if ($cart) {
                $cartItems = $cart->items->map(function ($cartItem) {
                    return [
                        'id' => $cartItem->product->id,

                        'name' => $cartItem->product ? $cartItem->product->name : 'N/A',
                        'price' => $cartItem->product ? $cartItem->product->price : 0,
                        'quantity' => $cartItem->quantity,
                        'image' => $cartItem->product ? $cartItem->product->featured_image : 'default-image.jpg',
                    ];
                });

                $totalPrice = $cartItems->sum(function ($item) {
                    return $item['price'] * $item['quantity'];
                });
            } else {
                $cartItems = [];
                $totalPrice = 0;
            }
            // Chia sẻ biến giỏ hàng với tất cả các view
            $view->with('cartItems', $cartItems)
                ->with('totalPrice', $totalPrice);
        });
        View::composer('cart.show', function ($view) {

            $view->with('provinces', Province::all())
                ->with('districts', District::all())
                ->with('wards', Ward::all());
        });
        Paginator::useBootstrap();
    }
}
