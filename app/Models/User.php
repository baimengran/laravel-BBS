<?php

namespace App\Models;

use App\Models\Traits\ActiveUserHelper;
use App\Models\Traits\LastActivedAtHelper;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\UserRegisterEmailVerification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;
    use ActiveUserHelper;//计算用户活跃度

    use LastActivedAtHelper;//最后活跃时间
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'introduction', 'phone',
        'company', 'position', 'work_address', 'img', 'weixin_openid',
        'weixin_unionid','registration_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function getJWTCustomClaims()
    {
        return [];
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


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
    public function markAsRead()
    {
        $this->notification_count = 0;
        $this->save();
        $this->unreadNotifications->markAsRead();
    }


    /**
     * Send the password reset notification.
     *
     * @param  string $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * 注册邮件通知
     * @param $user
     */
    public function sendRegisterNotification($user)
    {
        $this->notify(new UserRegisterEmailVerification($user));
    }

    public function setPasswordAttribute($value)
    {
        //如果password值的长度等于60，即当前password值已经加密
        if (strlen($value) != 60) {
            //不等于60做加密处理
            $value = bcrypt($value);
        }
        $this->attributes['password'] = $value;
    }

    public function setImgAttribute($path)
    {
        //如果不是http子串开头，说明此图片是后台上传的，需要补全url
        if (!starts_with($path, 'http')) {
            //拼接完成url
            $path = config('app.url') . "/uploads/images/avatars/$path";
        }
        $this->attributes['img'] = $path;
    }
}
