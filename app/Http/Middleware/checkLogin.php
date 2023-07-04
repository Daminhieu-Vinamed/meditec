<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user')) {
            if ($request->session()->get('user')->IsGroup == 0 && $request->session()->get('user')->IsActive == 1) {
                return $next($request);
            } else {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('form.getLogin')->with('error_incorrect','Tài khoản này không đủ quyền !');
            }
        }else{
            session()->flash('idParent', $request->id);
            return redirect()->route('form.getLogin')->with('error_incorrect','Đăng nhập thất bại !');
        }
    }
}
