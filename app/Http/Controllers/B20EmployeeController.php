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
            return response()->json(['fullName' => Auth::user()->Name, 'Code' => Auth::user()->Code, 'id' => $request->id]);
        }else{
            return response()->json(['errorLogin' => 'Sai tài khoản hoặc mật khẩu !', 'id' => $request->id]);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if (isset($request->id) && !empty($request->id)) {
            session()->flash('idParent', $request->id);
        }
        return redirect()->route('form.getLogin');
    }
    
    public function back(Request $request)
    {
        return redirect()->route('logout', ['id' => $request->id]);
    }
}
