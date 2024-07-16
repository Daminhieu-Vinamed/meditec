<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
    
    public function notification()
    {
        return view('notification');
    }
    
    public function postLogin(Request $request)
    {
        return $this->authService->postLogin($request);
    }

    public function logout(Request $request)
    {
        return $this->authService->logout($request);
    }
}