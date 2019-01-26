<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Topic;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    public function index(Topic $topic)
    {
        $comments = $topic->comment()
            ->with('user:id,name,img')
            ->where('parent_id', 0)
            ->orderBy('created_at', 'DESC')
            ->paginate(15);

//        dd($comments);
        return view('topics.__comment_list', ['comments' => $comments]);
    }

    public function reply(Topic $topic, Request $request)
    {
//        dd($topic);
        if($request->ajax()){
            //去除评论html id属性中‘replies’字符，并返回
            $id = str_ireplace('replies', '', trim($request->input('id')));
//            if($request->input('blo')){
//                $parent_id = $topic->comment()->where('parent_id',$id)->first(['parent_id']);
//                return $parent_id??'';
//            }
            $replies = $topic->comment()->where('parent_id', $id)
                ->with('parentUser:id,name', 'user:id,name,img')
                //->where('parent_id', '<>', 0)
                ->orderBy('created_at', 'DESC')
                ->paginate(3);
            //dd($replies->firstItem());
        return view('topics.__comments_reply_list', ['replies' => $replies]);

        }
        return '';
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }


    public function update()
    {

    }

    public function destroy()
    {

    }
}
