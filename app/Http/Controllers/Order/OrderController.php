<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        // dd($request);
        $provinceId = $request->province;
        $transport = Transport::where('province_id', $provinceId)->first();
        $shippingFee = $transport ? $transport->price : 0;
        $order = Order::create([
            'order_status_id' => 1,
            'customer_id' => Auth::guard('customer')->id(),
            'shipping_fullname' => $request->name,
            'shipping_mobile' => $request->mobile,
            'payment_method' => $request->payment_method,
            'shipping_ward_id' => $request->ward,
            'shipping_housenumber_street' => $request->address,
            'shipping_fee' =>  $shippingFee,
        ]);
        $orderItems = $request->input('order_items', []);
        foreach ($orderItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'],
                'total_price' =>  $item['unit_price'] + $shippingFee,
            ]);
        }

        $userId = auth()->guard('customer')->id();
        Cart::where('user_id', $userId)->delete();
        return view('cart.orderSuccess')->with('success', 'Đơn hàng đã được tạo thành công!');
    }

    public function getShippingFee(Request $request)
    {
        $request->validate([
            'province_id' => 'required|exists:provinces,id',
        ]);

        $provinceId = $request->input('province_id');
        $transport = Transport::where('province_id', $provinceId)->first();

        // Return shipping fee as JSON
        return response()->json([
            'price' => $transport ? $transport->price : 0
        ]);
    }
    public function myOrder($id)
    {
        $myOrder = Order::with('items.product', 'status')->where('customer_id', $id)->paginate(5);
        return view('cart.myOrder', ['myOrder' => $myOrder]);
    }
}
