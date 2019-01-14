<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicRequest;
use App\Models\User;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    //
    public function index()
    {
        return view('topic.index');
    }

    public function show()
    {
        return view('topic.show');
    }


    public function edit(TopicRequest $request, User $user)
    {

    }


    public function update(Request $request, User $user)
    {

    }
}
