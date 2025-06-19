<?php
namespace App\Http\Controllers\Sepay;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SePayController extends Controller
{
    public function createOrder(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'customer_id' => 'required|integer',
            'shipping_fullname' => 'required|string|max:100',
            'shipping_mobile' => 'required|string|max:15',
            'shipping_ward_id' => 'required|string|max:10',
            'shipping_housenumber_street' => 'required|string|max:200',
            'shipping_fee' => 'required|integer',
            'amount' => 'required|integer', // tổng giá trị đơn hàng
            'bank_code' => 'required|string|max:10', // VCB, MBB, ...
        ]);

        // Tạo mã đơn hàng
        $orderCode = 'ORDER' . time();

        // Lưu đơn hàng vào DB
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'shipping_fullname' => $request->shipping_fullname,
            'shipping_mobile' => $request->shipping_mobile,
            'shipping_ward_id' => $request->shipping_ward_id,
            'shipping_housenumber_street' => $request->shipping_housenumber_street,
            'shipping_fee' => $request->shipping_fee,
            'payment_method' => 1, // 1 = thanh toán qua ngân hàng (SePay)
            'order_status_id' => 1, // ví dụ: 1 = chờ thanh toán
        ]);

        // Gọi API SePay
        $response = Http::withOptions([
            'verify' => false, // TẠM THỜI tắt verify SSL - chỉ dùng để test
            'connect_timeout' => 30,
        ])->post('https://api.sepay.vn/v1/order/create', [
            'amount' => $request->amount,
            'bank_code' => $request->bank_code,
            'description' => 'Thanh toán đơn hàng #' . $order->id,
            'order_code' => $orderCode,
        ]);
        dd($response);
        $data = $response->json();

        if ($response->successful() && isset($data['data']['checkout_url'])) {
            // Nếu cần, bạn có thể lưu transaction_id hoặc thông tin khác ở đây
            $order->update([
                'sepay_transaction_id' => $data['data']['transaction_id'] ?? null,
            ]);

            return response()->json([
                'message' => 'Tạo đơn hàng thành công',
                'checkout_url' => $data['data']['checkout_url'], // trả về link để khách thanh toán
                'order_id' => $order->id,
            ]);
        }

        return response()->json([
            'message' => 'Lỗi khi tạo đơn hàng với SePay',
            'error' => $data,
        ], 500);
    }
}
