<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\TopicRequest;
use App\Models\Topic;
use App\Models\User;
use App\Transformers\TopicTransformer;
use Illuminate\Http\Request;

class TopicsController extends Controller
{

    /**
     * 话题列表
     * @param Request $request
     * @param Topic $topic
     * @return \Dingo\Api\Http\Response
     */
    public function index(Request $request, Topic $topic)
    {
        $query = $topic->query();

        if ($categoryId = $request->input('category_id')) {
            $query->where('category_id', $categoryId);
        }

        switch ($request->input('order')) {
            case 'recent':
                $query->recent();
                break;
            default:
                $query->recentReplied();
                break;
        }

        $topic = $query->paginate(15);

        return $this->response->paginator($topic, new TopicTransformer($request->input('fields')));
    }

    /**
     * 用户话题列表
     * @param User $user
     * @param Request $request
     * @return \Dingo\Api\Http\Response
     */
    public function userIndex(User $user, Request $request)
    {
        $topics = $user->topic()->recent()->paginate(15);

        return $this->response->paginator($topics, new TopicTransformer());
    }


    public function show(Topic $topic)
    {
        return $this->response->item($topic, new TopicTransformer());
    }

    //
    public function store(TopicRequest $request, Topic $topic)
    {
        $topic->fill($request->all());
        $topic->user_id = $this->user()->id;
        $topic->save();

        return $this->response->item($topic, new TopicTransformer())->setStatusCode(201);
    }


    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $topic->update($request->all());

        return $this->response->item($topic, new TopicTransformer());
    }


    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();
        return $this->response->noContent();
    }
}
