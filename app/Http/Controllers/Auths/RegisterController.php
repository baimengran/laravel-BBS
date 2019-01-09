<?php

namespace App\Http\Controllers\Auths;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    //

    public function show()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->img=$user->gravatar(140);
        $user->save();
        \Auth::login($user,$request->has('rememberme'));
        return redirect()->route('home');
    }
}
