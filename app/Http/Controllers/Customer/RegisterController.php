<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\RegistrationConfirmation;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // dd($request);
        $user = Customer::create([
            'name' => $request->input('name'),
            'mobile' => $request->input('mobile'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'is_active' => 0,
            'activation_token' => Str::random(10),
        ]);


        Mail::to($request->email)->send(new RegistrationConfirmation($user));
        return redirect('/')->with('success', 'Đăng ký thành công hãy kiểm tra email để kích hoạt.');
    }
    public function activate($token)
    {
        $user = Customer::where('activation_token', $token)->firstOrFail();

        $user->update([
            'is_active' => 1,
            'activation_token' => null, // Xóa token sau khi xác thực
        ]);

        return redirect('/')->with('success', 'Tài khoản đã được kích hoạt. Bạn có thể đăng nhập.');
    }
}
