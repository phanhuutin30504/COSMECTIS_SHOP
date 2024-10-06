<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.Login-form');
    }
    public function login(Request $request){
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string|min:6',
        ]);
          $user = $request->only('username','password');
          if(Auth::attempt($user)){
                 return redirect()->route('admin.dashboard');
          }else{
            return redirect()->back()->withErrors([
                'error' => 'Thông tin đăng nhập không chính xác.',
            ]);
          }
    }
    public function logout(Request $request){
        Auth::logout();

        $request->session()->regenerateToken();
        return redirect()->route('login');
     }
}
