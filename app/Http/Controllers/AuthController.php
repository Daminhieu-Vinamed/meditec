<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;
    
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function getLogin()
    {
        return view('login');
    }
    
    public function postLogin(Request $request)
    {
        return $this->authService->postLogin($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
    
    public function back(Request $request)
    {
        return redirect()->route('logout', ['id' => $request->id]);
    }
}
