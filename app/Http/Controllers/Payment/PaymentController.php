<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\CartHelper;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function createOrder(Request $request)
    {
        $response = Http::withToken(env('SEPAY_API_KEY'))->post('https://api.sepay.vn/v1/order/create', [
            'amount' => 200000,
            'bank_code' => 'VCB',
            'description' => 'Thanh toán đơn hàng #123',
            'order_code' => 'ORDER123',
        ]);

        $data = $response->json();

        // Hiển thị thông tin QR / nội dung chuyển khoản cho người dùng
        return 'ok';
    }
}
