<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CartHelper;
class CartController extends Controller
{
    protected $cartHelper;
    public function __construct(CartHelper $cartHelper)
    {
        $this->cartHelper = $cartHelper;
    }
    public function addToCart(Request $request)
    {

        $user = auth()->guard('customer')->user();
        $productId = $request->input('product_id');
        $quantity = $request->input('qty', 1);

        $this->cartHelper->addToCart($user->id, $productId, $quantity);

        return redirect()->back();
    }

    public function showCart()
    {

        $user = auth()->guard('customer')->user();
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();
        // không có giỏ hàng, trả về view với giỏ hàng trống
        if (!$cart) {
            return view('cart.show', ['cartItems' => [], 'totalPrice' => 0]);
        }
        // Lấy các sản phẩm từ giỏ hàng
        $cartItems = $cart->items->map(function ($cartItem) {
            return [
                'id' => $cartItem->product->id,
                'name' => $cartItem->product ? $cartItem->product->name : 'N/A',
                'price' => $cartItem->product ? $cartItem->product->price : 0,
                'quantity' => $cartItem->quantity,
                'image' => $cartItem->product ? $cartItem->product->featured_image : 'default-image.jpg' // Sử dụng ảnh mặc định nếu không có
            ];
        });
        // Tính tổng giá trị của giỏ hàng
        $totalPrice = $cartItems->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
        // dd($totalPrice);

        return view('cart.show', compact('cartItems', 'totalPrice','user'));
    }


    public function removeFromCart(Request $request, $productId)
    {
        $user = auth()->guard('customer')->user();
        $this->cartHelper->removeFromCart($user->id, $productId);



        return redirect()->back();
    }



// Làm cart bằng session
    // public function addToCart(Request $request)
    // {
    //     $productId = $request->input('product_id');
    //     $quantity = $request->input('qty', 1);

    //     $product = Product::findOrFail($productId);

    //     $cart = session()->get('cart', []);
    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] += $quantity;
    //     } else {
    //         $cart[$productId] = [
    //             'id'=>$product->id,
    //             'name' => $product->name,
    //             'quantity' => $quantity,
    //             'price' => $product->price,
    //             'image' => $product->featured_image,
    //         ];
    //     }
    //     session()->put('cart', $cart);
    //     return redirect()->route('cart.show');
    // }

    // public function showCart()
    // {
    //     $cart = session()->get('cart', []);

    //     $totalPrice = array_sum(array_map(function ($item) {
    //         return $item['price'] * $item['quantity'];
    //     }, $cart));

    //     return view('cart.show', compact('cart', 'totalPrice'));
    // }

}
