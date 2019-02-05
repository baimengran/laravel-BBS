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
        $this->middleware('auth', ['except' => ['show']]);
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
    public function show(User $user, Request $request, $notification = null)
    {

        if (!$request->ajax() && $notification&&\Auth::check()) {
            $notifications = \Auth::user()->notifications()->paginate(15);
            \Auth::user()->markAsRead();
            return view('users.show', ['user' => $user, 'notifications' => $notifications]);
        }

        $topics = $user->topic()->orderBy('created_at', 'DESC')->paginate(15);
        if ($request->ajax()) {

            switch ($request->input('reque')) {
                case 'showBasic':
                    dd(1);
                    return view('users.__showBasic', ['user' => $user]);
                case 'showTopic':
                    return view('users.__showInfo', ['user' => $user, 'topics' => $topics]);
                case 'showConsult':
                    $topics = $user->topic()->where('category_id', 3)->orderBy('created_at', 'DESC')->paginate(15);
                    return view('users.__showInfo', ['user' => $user, 'topics' => $topics, 'title' => '问答']);
                case 'showReply':
                    $comments = $user->comment()->with('topic')->orderBy('created_at', 'DESC')->paginate(15);
                    //dd($comments);
                    return view('users.__showInfo', ['user' => $user, 'comments' => $comments]);
                case 'showNotification':
                    $notifications = \Auth::user()->notifications()->paginate(15);
                    \Auth::user()->markAsRead();
                    return view('users.__showInfo', ['notifications' => $notifications]);
                case 'showAttentionUser':
                    return response()->json(['']);
                case 'showLike':
                    return response()->json(['']);
            }
        }

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
        $viewName = 'users.__' . $request->input('reque');
        return view($viewName, ['user' => $user]);
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
