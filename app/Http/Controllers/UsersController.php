<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use function MongoDB\BSON\toJSON;

class UsersController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        $topics = $user->topic()->paginate(15);
        //$this->authorize('view', $user);
        return view('users.show', ['user' => $user, 'topics' => $topics]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $this->authorize('view', $user);
        $content = 'users.' . $request->input('reque');
        return view($content, ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update($data, $user)
    {
        $this->authorize('update', $user);
        $user->update($data);
        return json_encode('111');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function editBasic(UserRequest $request, User $user)
    {
        $this->update($request->all(), $user);
    }

    public function editAvatar(UserRequest $request, ImageUploadHandler $uploader, User $user)
    {
        $data[] = null;
        if ($request->img) {
            $result = $uploader->save($request->img, 'avatars', $user->id, 500);
            if ($result) {
                $data['img'] = $result['path'];
                //return $result['path'];
                $this->update($data, $user);
            }
        }
        //$this->update($request->all(),$user);
    }
}
