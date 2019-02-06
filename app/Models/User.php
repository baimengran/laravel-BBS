<?php

namespace App\Models;

use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserRegisterEmailVerification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'phone', 'company', 'position', 'work_address', 'img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function gravatar($email, $size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'] ?? $email)));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }


    public function topicNotify($instance)
    {
        //如果要通知的是当前用户，则不进行通知操作
        if ($this->id == \Auth::id()) {
            return;
        }
        $this->increment('notification_count');
        $this->notify($instance);
    }

    /**
     * 数据库通知标记已读
     */
    public function markAsRead(){
        $this->notification_count=0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function sendRegisterNotification($user){
        $this->notify(new UserRegisterEmailVerification($user));
    }
}
