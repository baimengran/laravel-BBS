<?php

namespace App\Http\Controllers\Api\V1;

use App\Transformers\NotificationsTransformer;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    //
    public function index()
    {
        $notifications = $this->user->notifications()->paginate(15);

        return $this->response->paginator($notifications, new NotificationsTransformer());
    }

    /**
     * 消息统计
     * @return mixed
     */
    public function stats()
    {
        return $this->response->array([
            'unread_count' => $this->user()->notification_count,
        ]);
    }

    public function read()
    {
        $this->user()->markAsRead();
        return $this->response->noContent();
    }

}
