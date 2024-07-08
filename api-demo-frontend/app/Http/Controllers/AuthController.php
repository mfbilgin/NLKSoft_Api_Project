<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function post_login(Request $request)
    {
        $data = $request->only(['email', 'password']);
        $response = $this->userService->login($data);
        if ($response['access_token']) {
            return redirect()->route('product.index')->cookie('token', $response['access_token'], 60, null, null, false, true);
        }
        return redirect()->route('product.index');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function post_register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
        $this->userService->register($data);
        return redirect()->route('login');
    }

    public function logout()
    {
        $this->userService->logout();

        return redirect()->route('login')->cookie(cookie()->forget('token'));
    }

}
