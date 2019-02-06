<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/5
 * Time: 19:43
 */

namespace App\Policies;


use Illuminate\Auth\Access\HandlesAuthorization;

class Policy
{
    use HandlesAuthorization;


    public function before($user, $ability)
    {
        //如果用户拥有管理内容权限，即授权通过
        if ($user->can('manage_contents')) {
            return true;
        }
    }
}