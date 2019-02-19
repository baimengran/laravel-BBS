<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/19
 * Time: 20:00
 */

namespace App\Transformers;


use Illuminate\Notifications\DatabaseNotification;
use League\Fractal\TransformerAbstract;

class NotificationsTransformer extends TransformerAbstract
{

    public function transform(DatabaseNotification $databaseNotification)
    {
        return [
            'id' => $databaseNotification->id,
            'type' => $databaseNotification->type,
            'data' => $databaseNotification->data,
            'read_at' =>$databaseNotification->read_at?$databaseNotification->read_at->toDateTimeString():null,
            'created_at' => $databaseNotification->created_at->toDateTimeString(),
            'update_at' => $databaseNotification->updated_at->toDateTimeString(),
        ];
    }
}