<?php

namespace App\Http\Controllers\Auths;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if (\Auth::attempt($credentials,$request->has('rememberme'))) {
            session()->flash('success', '登录成功');
            return redirect()->route('home');
        } else {
            session()->flash('error', '邮箱或密码不正确');
            return back();
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home');
    }
}
