<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra nếu chưa đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login')
                        ->withErrors('Bạn cần đăng nhập để truy cập.');
        }

        // Kiểm tra nếu là user thì chuyển hướng đến trang client
        if (Auth::user()->role === 'user') {
            return redirect()->route('clients.home');
        }

        // Nếu là admin thì cho phép truy cập
        if (Auth::user()->role === 'admin') {
            return $next($request);
        }

        // Nếu không phải admin hoặc user, chuyển hướng đến trang đăng nhập
        return redirect()->route('login')
                    ->withErrors('Bạn không đủ quyền truy cập.');
    }
}