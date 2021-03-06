<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Http;
use App\Models\LogUrlModel;
use App\Models\UrlModel;

class LoginController extends Controller
{
    public function login()
    {
        return view('login/login');
    }

    public function logar(LoginUserRequest $request)
    {
        if (Auth::attempt(["email" => $request->email, "password" => $request->password])) {

            return redirect()->route('index.url');
        }

        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return true;
    }
}
