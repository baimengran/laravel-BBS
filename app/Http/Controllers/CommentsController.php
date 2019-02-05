<?php

namespace App\Http\Controllers;

use App\Exceptions\DataBaseException;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth', ['except' => ['index', 'reply']]);
    }

    //
    public function index(Topic $topic)
    {
        $comments = $topic->comment()
            ->with('user:id,name,img')
            ->where('parent_id', 0)
            ->paginate(3);

//        dd($comments);
        return view('topics.__comment_list', ['comments' => $comments]);
    }

    public function reply(Topic $topic, Request $request)
    {
//        dd($topic);
        if ($request->ajax()) {
            //去除评论html id属性中‘replies’字符，并返回
            $id = str_ireplace('replies', '', trim($request->input('id')));
//            if($request->input('blo')){
//                $parent_id = $topic->comment()->where('parent_id',$id)->first(['parent_id']);
//                return $parent_id??'';
//            }
            $replies = $topic->comment()->where('parent_id', $id)
                ->with('parentUser:id,name', 'user:id,name,img')
                //->where('parent_id', '<>', 0)
//                ->orderBy('created_at', 'DESC')
                ->paginate(3);
            //dd($replies->firstItem());
            return view('topics.__comments_reply_list', ['replies' => $replies]);

        }
        return '';
    }

    public function create()
    {

    }

    public function store(CommentRequest $request, Comment $comment)
    {
        $comment->topic_id = $request->input('topic_id');
        $comment->user_id = \Auth::id();
        $comment->content = $request->input('content');
        if ($request->has(['id', 'user_id', 'parent_id', 'parent_user_id'])) {
            if ($request->input('parent_id') == 0 && $request->input('parent_user_id') == 0) {
                $comment->parent_id = $request->input('id');
            } else {
                $comment->parent_id = $request->input('parent_id');
            }

            $comment->parent_user_id = $request->input('user_id');
        }
        if ($comment->save()) {
            return 1;
        }
        return 0;
    }

    public function edit(Comment $comment)
    {

    }


    public function update()
    {

    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(['msg' => '删除成功']);
    }

}
