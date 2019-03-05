<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/4
 * Time: 14:58
 */

namespace App\Observers;


use App\Models\User;

class UserObserver
{

    public function created(User $user)
    {
        if($user->email){
            $user->verification_token = str_random(30);
            $user->save();
            $user->sendRegisterNotification($user);
        }
    }
}