<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CustomerRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('customer')->check()) {
            // Chuyển hướng đến trang đăng nhập
            return redirect()->route('index')->with('error', 'Bạn cần đăng nhập để thực hiện hành động này.');
        }
        return $next($request);
    }
}
