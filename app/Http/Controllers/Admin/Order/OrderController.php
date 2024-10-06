<?php

namespace App\Http\Controllers\Admin\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders =Order::with('customer','items','status')->get();
        return view('admin.order.list',compact('orders'));
    }



    public function confirmOrder($id)
{
    $order = Order::find($id);

    if ($order) {
        $order->order_status_id = 2; // Cập nhật trạng thái thành 1
        $order->save();
        return response()->json(['success' => true, 'message' => 'Đã xác nhận đơn hàng!']);
    }

    return response()->json(['success' => false, 'message' => 'Đơn hàng không tồn tại!'], 404);
}

}
