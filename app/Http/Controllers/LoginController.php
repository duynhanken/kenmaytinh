<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function getLogin()
    {
        if (Auth::check()) {
            return redirect()->route('get-admin-home');
        } else {
            return view('admin.login.login');
        }
    }

    public function postLogin(request $request)
    {   
        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'status'   =>1
        ];
        if (Auth::attempt($login)) {
            $user = Auth::user();
            return redirect()->route('get-admin-home');
        }
        else 
        {
            return view('admin.login.login')->with('message', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return view('admin.Login.login');
    }
}
