<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('user')) {
            if ($request->session()->get('user')->IsGroup == config('constants.number.zero') && $request->session()->get('user')->IsActive == config('constants.number.one')) {
                return $next($request);
            } else {
                $request->session()->forget('user');
                return redirect()->route('form.getLogin')->with('error_incorrect', __('messages.auth.not_enough_rights'));
            }
        } else {
            return redirect()->route('form.getLogin');
        }
    }
}