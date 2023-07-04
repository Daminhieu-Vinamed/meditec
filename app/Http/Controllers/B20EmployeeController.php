<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class B20EmployeeController extends Controller
{
    public function getLogin()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        if (Auth::attempt(['Code' => $request->Code, 'password' => $request->password])) {
            session(['user' => Auth::user()]);
            if (isset($request->id) && !empty($request->id)) {
                return redirect()->route('list.edit',['id' => $request->id]);
            }
            return redirect()->route('list.notification');
        }
        return redirect()->route('form.getLogin')->with('error_incorrect', 'Sai tài khoản hoặc mật khẩu !');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('form.getLogin');
    }
}
