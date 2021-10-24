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
        foreach(UrlModel::get() as $url)
        {
            $data = Http::get("$url->url");

            LogUrlModel::create(["id_url" => $url->id_url,
                "data"          => strval(mb_substr($data->__toString(), 0, 7000)),
                "status_code"   => $data->status(),
                "date"          => $data->header('Date')
            ]);
        }
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
