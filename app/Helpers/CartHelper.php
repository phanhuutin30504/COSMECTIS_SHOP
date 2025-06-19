<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartHelper
{
    public function addToCart($userId, $productId, $quantity)
    {
        // Tìm hoặc tạo giỏ hàng cho người dùng
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
        $cartItem = CartItem::where('cart_id', $cart->id)
                    ->where('product_id', $productId)
                    ->first();

        if ($cartItem) {
            // Cập nhật số lượng sản phẩm
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Thêm sản phẩm mới vào giỏ hàng
            $product = Product::findOrFail($productId);
            // dd($product);
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $product->price,
                'image'=>$product->featured_image
            ]);
        }
    }

    public function getCartItems($userId)
    {
        $cart = Cart::where('user_id', $userId)->first();
        return $cart ? $cart->items()->get() : [];
    }

    public function getTotalPrice($userId)
    {
        $items = $this->getCartItems($userId);
        return $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }

    public function removeFromCart($userId, $productId)
    {
        $cart = Cart::where('user_id', $userId)->first();

        if ($cart) {
            $cartItem = CartItem::where('cart_id', $cart->id)
                        ->where('product_id', $productId)
                        ->first();

            if ($cartItem) {
                $cartItem->delete();
            }
        }
    }
}
