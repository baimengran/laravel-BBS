<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\CommentRequest;
use App\Models\Comment;
use App\Models\Topic;
use App\Transformers\CommentTransformer;
use Illuminate\Http\Request;


class CommentsController extends Controller
{
    //
    public function store(CommentRequest $request, Comment $comment, Topic $topic)
    {

        $comment->content = $request->input('content');
        $comment->topic_id = $topic->id;
        $comment->user_id = $this->user()->id;
        $comment->parent_id = $request->input('parent_id')??0;
        $comment->parent_user_id = $request->input('parent_user_id')??0;

        $comment->save();

        return $this->response->item($comment, new CommentTransformer())->setStatusCode(201);
    }
}
