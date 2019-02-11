<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/9
 * Time: 12:42
 */

namespace App\Http\ViewComposers;


use App\Models\Link;
use App\Models\User;
use Illuminate\View\View;

class ActiveUser
{

    protected $active_users;
    protected $links;

    public function __construct(User $user, Link $link)
    {
        $this->active_users = $user->getActiveUsers();
        $this->links = $link->getAllCached();
    }

    public function compose(View $view)
    {
        $view->with('active_users', $this->active_users);
        $view->with('links', $this->links);

    }
}