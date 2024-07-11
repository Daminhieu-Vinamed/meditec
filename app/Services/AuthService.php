<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService 
{
    public function postLogin($request)
    {
        if (Auth::attempt(['Code' => $request->Code, 'password' => $request->password])) {
            session(['user' => Auth::user()]);
            return response()->json(['fullName' => Auth::user()->Name, 'Code' => Auth::user()->Code]);
        }else{
            return response()->json(['errorLogin' => __('messages.auth.wrong')]);
        }
    }

    public function logout($request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('form.getLogin');
    }
}