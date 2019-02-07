<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/11
 * Time: 0:43
 */


function model_admin_link($title,$model){
    return model_link($title,$model,'admin');
}

/**
 * 根据标题和模型获取标题url
 * @param $title
 * @param $model
 * @param string $prefix
 * @return string
 */
function model_link($title,$model,$prefix=''){
    //获取数据模型的复数蛇形命名
    $model_name=model_plural_name($model);

    //初始化前缀
    $prefix=$prefix?"/$prefix/":'/';

    //使用站点url拼接圈梁url
    $url = config('app.url').$prefix.$model_name.'/'.$model->id;

    //拼接HTML A标签，并返回
    return '<a href="'.$url.'" target="_blank">'.$title.'</a>';
}

/**
 * 根据模型获取模型类名的蛇形复数名
 * @param $model
 * @return string
 */
function model_plural_name($model){
    //从实体中获取完成类名，例如：App\Models\User
    $full_class_name=get_class($model);

    //获取基础类名，例如：'App\Models\User' 得到'User'
    $class_name=class_basename($full_class_name);

    //蛇形命名，例如：'User' 得到 'user','FooBar' 得到 'foo_bar'
    $snake_case_name=snake_case($class_name);

    //获取子串的复数形式，例如： 'user' 得到 'users'
    return str_plural($snake_case_name);
}

/**
 * 设置当前url到session
 *
 */
function setSessionCurrentUrl()
{
    return session(['re_lo_url'=>url()->current()]);
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