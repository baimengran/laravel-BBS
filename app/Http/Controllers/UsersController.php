<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [],
        ]);
    }

    //
    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user, Request $request)
    {
        $content = 'users.';
        switch ($request->input('reque')) {
            case 'edPw':
                $content=$content.'editPwd';
        }

        return view($content, ['user' => $user]);
    }


}
