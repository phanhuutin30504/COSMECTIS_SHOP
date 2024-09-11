<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $customer = Customer::where('email', $request->input('email'))->first();
        if ($customer) {
            if ($customer->is_active == 0) {
                // Nếu tài khoản chưa được kích hoạt
                return redirect()->back()->withErrors([
                    'error' => 'Tài khoản của bạn chưa được kích hoạt. Vui lòng kiểm tra email để kích hoạt tài khoản.',
                ]);
            }
            // Nếu tài khoản đã được kích hoạt, đăng nhập

            if (Auth::guard('customer')->attempt($credentials)) {
                return redirect()->intended('/')->with('success', 'Đăng nhập thành công');
            } else {
                return redirect()->back()->withErrors([
                    'error' => 'Thông tin đăng nhập không chính xác.',
                ]);
            }
        } else {
            return redirect()->back()->withErrors([
                'error' => 'Email không tồn tại.',
            ]);
        }
    }
    public function logout(Request $request){
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
