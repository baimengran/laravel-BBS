<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 0:43
 */

/**
 * 后台底部导航设置操作权限控制函数,config/administrator/settings/site_footer.php调用
 */
if (!function_exists('administrator_action_site_footer')) {
    function administrator_action_site_footer(&$data)
    {
        \Artisan::call('cache:clear');
        return true;
    }
}

/**
 * 后台底部导航设置操作权限控制函数,config/administrator/settings/site_footer.php调用
 */
if (!function_exists('administrator_site_footer_founder')) {
    function administrator_site_footer_founder()
    {
        //只能站长管理站点配置
        return Auth::check() && Auth::user()->hasRole('Founder');
    }
}

/**
 * 后台站点设置清除缓存功能函数,config/administrator/settings/site.php调用
 */
if (!function_exists('administrator_site_action')) {
    function administrator_site_action(&$data)
    {
        \Artisan::call('cache:clear');
        return true;
    }
}

/**
 * 后台站点设置自动添加后缀函数,config/administrator/settings/site.php调用
 */
if (!function_exists('administrator_site_before_save')) {
    function administrator_site_before_save(&$data)
    {
        //为网站名称加后缀，加上判断是为防止多次添加
        if (strpos($data['site_name'], 'Powered By LaraBlogTwo') === false) {
            $data['site_name'] .= ' - Powered By LaraBlogTwo';
        }
    }
}

/**
 * 后台站点设置操作权限控制函数,config/administrator/settings/site.php调用
 */
if (!function_exists('administrator_site_founder')) {
    function administrator_site_founder()
    {
        //只能站长管理站点配置
        return Auth::check() && Auth::user()->hasRole('Founder');
    }
}

/**
 * 后台帖子分类显示样式函数,config/administrator/topics.php调用
 */
if (!function_exists('administrator_topics_category')) {
    function administrator_topics_category($value, $model)
    {
        return model_admin_link($model->category->name, $model->category);
    }
}

/**
 * 后台帖子作者显示样式函数,config/administrator/topics.php调用
 */
if (!function_exists('administrator_topics_user')) {
    function administrator_topics_user($value, $model)
    {
        $img = $model->user->img;
        $value = empty($img) ? 'N/A' : '<img src="' . $img . '" style="height:22px;width:22px"> ' . $model->user->name;
        return model_link($value, $model->user);
    }
}

/**
 * 后台帖子标题显示样式函数,config/administrator/topics.php调用
 */
if (!function_exists('administrator_topics_title')) {
    function administrator_topics_title($value, $model)
    {
        return '<div style="max-width:260px">' . model_link($value, $model) . '</div>';
    }
}

/**
 * 后台角色操作显示样式函数,config/administrator/roles.php调用
 */
if (!function_exists('administrator_roles_operation')) {
    function administrator_roles_operation($value, $model)
    {
        return $value;
    }
}

/**
 * 后台角色权限显示样式函数,config/administrator/roles.php调用
 */
if (!function_exists('administrator_roles_permissions')) {
    function administrator_roles_permissions($value, $model)
    {
        $model->load('permissions');
        $result = [];
        foreach ($model->permissions as $permission) {
            $result[] = $permission->name;
        }
        return empty($result) ? 'N/A' : implode($result, ' | ');
    }
}

/**
 * 后台CRUD 动作的单独权限控制函数,
 * config/administrator/permissions.php调用
 */
if (!function_exists('action_permissions_create')) {
    function action_permissions_create($model)
    {
        return true;
    }
}

/**
 * 后台CRUD 动作的单独权限控制函数,
 * config/administrator/permissions.php调用
 */
if (!function_exists('action_permissions_update')) {
    function action_permissions_update($model)
    {
        return true;
    }
}

/**
 * 后台CRUD 动作的单独权限控制函数,
 * config/administrator/permissions.php调用
 */
if (!function_exists('action_permissions_delete')) {
    function action_permissions_delete($model)
    {
        return false;
    }
}

/**
 * 后台CRUD 动作的单独权限控制函数,
 * config/administrator/permissions.php调用
 */
if (!function_exists('action_permissions_view')) {
    function action_permissions_view($model)
    {
        return true;
    }
}

/**
 * 后台资源推荐权限控制函数,config/administrator/links.php调用
 */
if (!function_exists('administrator_links_founder')) {
    function administrator_links_founder()
    {
        //只允许站长管理
        return Auth::check() && Auth::user()->hasRole('Founder');
    }
}

/**
 * 后台评论话题样式函数,config/administrator/comments.php调用
 */
if (!function_exists('administrator_comments_topic')) {
    function administrator_comments_topic($value, $model)
    {
        return '<div style="max-width:260px">' . model_admin_link(e($model->topic->title), $model->topic) . '</div>';
    }
}

/**
 * 后台评论作者样式函数,config/administrator/comments.php调用
 */
if (!function_exists('administrator_comments_user')) {
    function administrator_comments_user($value, $model)
    {
        $img = $model->user->img;
        $value = empty($img) ? 'N/A' : '<img src="' . $img . '" style="height:22px;width:22px"> ' . $model->user->name;
        return model_link($value, $model->user);
    }
}

/**
 * 后台评论内容样式函数，config/administrator/comments.php调用
 */
if (!function_exists('administrator_comments_content')) {
    function administrator_comments_content($value, $model)
    {
        return '<div style="max-width:220px">' . $value . '</div>';
    }
}

/**
 * 后台分类是否允许子分类样式函数，config/administrator/categories.php调用
 */
if (!function_exists('administrator_categories_is_son')) {
    function administrator_categories_is_son($is_son, $model)
    {
        if ($is_son == 1) {
            return '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>';
        } else if ($is_son == 0) {
            return '<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>';
        } else {
            return 'N/A';
        }
    }
}

/**
 * 后台分类删除权限控制函数，config/administrator/categories.php调用
 */
if (!function_exists('administrator_categories_founder')) {
    function administrator_categories_founder()
    {
        //只有站长才能删除
        return Auth::check() && Auth::user()->hasRole('Founder');
    }
}

/**
 * 后台用户数据中昵称添加超链接操作函数，config/administrator/users.php调用
 */
if (!function_exists('administrator_users_name')) {
    function administrator_users_name($name, $model)
    {
        return '<a href="/users/' . $model->id . '" target=_blank>' . $name . '</a>';
    }
}

/**
 * 后台用户数据中头像展示操作函数，config/administrator/users.php调用
 */
if (!function_exists('administrator_users_avatar')) {
    function administrator_users_avatar($img, $model)
    {
        return empty($img) ? 'N/A' : '<img src="' . $img . '" width="40">';
    }
}

/**
 * 后台用户数据展示权限函数，
 * config/administrator/users.php调用
 * config/administrator/permissions.php调用
 * config/administrator/roles.php调用
 */
if (!function_exists('manage_users')) {
    function manage_users()
    {
        return Auth::check() && Auth::user()->can('manage_users');
    }
}

/**
 * 后台访问权限函数，config/administrator.php中调用
 */
if (!function_exists('manage_contents')) {
    function manage_contents()
    {
        return Auth::check() && Auth::user()->can('manage_contents');
    }
}


function model_admin_link($title, $model)
{
    return model_link($title, $model, 'admin');
}

/**
 * 根据标题和模型获取标题url
 * @param $title
 * @param $model
 * @param string $prefix
 * @return string
 */
function model_link($title, $model, $prefix = '')
{
    //获取数据模型的复数蛇形命名
    $model_name = model_plural_name($model);

    //初始化前缀
    $prefix = $prefix ? "/$prefix/" : '/';

    //使用站点url拼接圈梁url
    $url = config('app.url') . $prefix . $model_name . '/' . $model->id;

    //拼接HTML A标签，并返回
    return '<a href="' . $url . '" target="_blank">' . $title . '</a>';
}

/**
 * 根据模型获取模型类名的蛇形复数名
 * @param $model
 * @return string
 */
function model_plural_name($model)
{
    //从实体中获取完成类名，例如：App\Models\User
    $full_class_name = get_class($model);

    //获取基础类名，例如：'App\Models\User' 得到'User'
    $class_name = class_basename($full_class_name);

    //蛇形命名，例如：'User' 得到 'user','FooBar' 得到 'foo_bar'
    $snake_case_name = snake_case($class_name);

    //获取子串的复数形式，例如： 'user' 得到 'users'
    return str_plural($snake_case_name);
}

/**
 * 设置当前url到session
 *
 */
function setSessionCurrentUrl()
{
    return session(['re_lo_url' => url()->current()]);
}

/**
 * 返回路径名称供页面class使用
 * @return string 路由名称字符串
 */
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}

/**
 * 截取字符串
 * @param $value
 * @param int $length
 * @return string
 */
function make_excerpt($value, $length = 200)
{
    $excerpt = trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));
    return str_limit($excerpt, $length);
}

/**
 * 截取字符串长度
 * @param string $string 要截取的字符串
 * @param integer $sublen 长度
 * @param int $start 截取字符串起始位置，默认0
 * @param string $code 字符编码
 * @return string 截取后字符串
 */
function cut_str($string, $sublen, $start = 0, $code = 'UTF-8')
{
//    if(){
//
//    }
    if ($code == 'UTF-8') {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if (count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)) . ".....";
        return join('', array_slice($t_string[0], $start, $sublen));
    } else {
        $start = $start * 2;
        $sublen = $sublen * 2;
        $strlen = strlen($string);
        $tmpstr = '';
        for ($i = 0; $i < $strlen; $i++) {
            if ($i >= $start && $i < ($start + $sublen)) {
                if (ord(substr($string, $i, 1)) > 129) {
                    $tmpstr .= substr($string, $i, 2);
                } else {
                    $tmpstr .= substr($string, $i, 1);
                }
            }
            if (ord(substr($string, $i, 1)) > 129) $i++;
        }
        if (strlen($tmpstr) < $strlen) $tmpstr .= "";
        return $tmpstr;
    }
}